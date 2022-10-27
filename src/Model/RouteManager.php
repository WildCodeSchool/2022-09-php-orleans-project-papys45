<?php

namespace App\Model;

use PDO;

class RouteManager extends AbstractManager
{
    public const TABLE = 'route';

    public function selectAll(string $orderBy = 'date', string $direction = 'DESC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
