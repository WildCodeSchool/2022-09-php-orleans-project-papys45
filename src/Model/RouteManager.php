<?php

namespace App\Model;

use PDO;

class RouteManager extends AbstractManager
{
    public const TABLE = 'route';


    public function insert(array $route): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (
            `date`,
            `time`,
            `start`,
            `finish`,
            `ravito`,
            `distance`,
            `difficulty`,
            `gpx`,
            `description`) 
            VALUES (
                :date,
                :time,
                :start,
                :finish,
                :ravito,
                :distance,
                :difficulty,
                :gpx,
                :description
                )");

        $statement->bindValue('date', $route['date'], PDO::PARAM_STR);
        $statement->bindValue('time', $route['time'], PDO::PARAM_STR);
        $statement->bindValue('start', $route['start'], PDO::PARAM_STR);
        $statement->bindValue('finish', $route['finish'], PDO::PARAM_STR);
        $statement->bindValue('ravito', $route['ravito'], PDO::PARAM_STR);
        $statement->bindValue('distance', $route['distance'], PDO::PARAM_INT);
        $statement->bindValue('difficulty', $route['difficulty'], PDO::PARAM_INT);
        $statement->bindValue('gpx', $route['gpx'], PDO::PARAM_STR);
        $statement->bindValue('description', $route['description'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
