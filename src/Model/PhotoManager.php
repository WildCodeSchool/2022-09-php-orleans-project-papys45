<?php

namespace App\Model;

use PDO;

class PhotoManager extends AbstractManager
{
    public const TABLE = 'photo';
    public function insertPhoto(array $photos, int $routeId)
    {
        foreach ($photos as $photo) {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
                " (`photo`,`route_id`)
            VALUES (:photo,:route_id)");

            $statement->bindValue('route_id', $routeId, PDO::PARAM_STR);
            $statement->bindValue('photo', $photo, PDO::PARAM_STR);

            $statement->execute();
        }
    }

    public function selectOneByIdWithPhoto(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . RouteManager::TABLE . ' AS r 
            LEFT JOIN ' . self::TABLE . ' AS p 
            ON r.id = p.route_id 
            WHERE r.id=:id');

        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchall();
    }
}
