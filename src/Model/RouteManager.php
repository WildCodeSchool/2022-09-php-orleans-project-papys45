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

    public function update(array $route): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET 
        `date` = :date,
        `time` = :time,
        `start` = :start,
        `finish` = :finish,
        `ravito = ravito,
        `distance = distance,
        `difficulty` = :difficulty,
        `gpx` = :gpx,
        `description` = :description,
        `rapport` = :rapport,
        WHERE id=:id");

        $statement->bindValue('id', $route['id'], PDO::PARAM_INT);
        $statement->bindValue('date', $route['date'], PDO::PARAM_STR);
        $statement->bindValue('time', $route['time'], PDO::PARAM_STR);
        $statement->bindValue('start', $route['start'], PDO::PARAM_STR);
        $statement->bindValue('finish', $route['finish'], PDO::PARAM_STR);
        $statement->bindValue('ravito', $route['ravito'], PDO::PARAM_STR);
        $statement->bindValue('distance', $route['distance'], PDO::PARAM_INT);
        $statement->bindValue('difficulty', $route['difficulty'], PDO::PARAM_INT);
        $statement->bindValue('gpx', $route['gpx'], PDO::PARAM_STR);
        $statement->bindValue('description', $route['description'], PDO::PARAM_STR);
        $statement->bindValue('rapport', $route['rapport'], PDO::PARAM_STR);
        return $statement->execute();
    }
}
