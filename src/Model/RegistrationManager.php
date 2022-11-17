<?php

namespace App\Model;

use PDO;
use App\Model\MemberManager;

class RegistrationManager extends AbstractManager
{
    public const TABLE = 'registration';

    public function selectByRouteId(int $routeId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . MemberManager::TABLE . " AS m
       INNER JOIN " . self::TABLE . " AS r on m.id= r.member_id 
       WHERE r.route_id=:id LIMIT 16");

        $statement->bindValue('id', $routeId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function insert(array $registration): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`member_id`,`route_id`) 
        VALUES (:member_id, :route_id)");
        $statement->bindValue('member_id', $registration['member_id'], PDO::PARAM_INT);
        $statement->bindValue('route_id', $registration['route_id'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
