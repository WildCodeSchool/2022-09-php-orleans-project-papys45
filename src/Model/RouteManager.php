<?php

namespace App\Model;

use PDO;

class RouteManager extends AbstractManager
{
    public const TABLE = 'route';

    public function update(array $route): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `date` =:date, 
        `time`=: time,
        `start`=: start,
        `finish`=: finish,
        `distance`=: distance
        WHERE id=:id");
        $statement->bindValue('date', $route['date'], PDO::PARAM_STR);
        $statement->bindValue('time', $route['time'], PDO::PARAM_STR);
        $statement->bindValue('start', $route['start'], PDO::PARAM_STR);
        $statement->bindValue('finish', $route['finish'], PDO::PARAM_STR);
        $statement->bindValue('distance', $route['distance'], PDO::PARAM_INT);

        return $statement->execute();
    }
}
