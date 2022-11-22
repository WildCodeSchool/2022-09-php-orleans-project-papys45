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


    public function deleteByRouteId(int $routeId, int $memberId): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE .
            " WHERE route_id=:routeId
       AND member_id=:memberId ");

        $statement->bindValue('routeId', $routeId, \PDO::PARAM_INT);
        $statement->bindValue('memberId', $memberId, \PDO::PARAM_INT);
        $statement->execute();
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

    public function selectMembersRegistrered(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . self::TABLE .
            ' AS r INNER JOIN ' . MemberManager::TABLE . ' AS m ON r.route_id=:id  WHERE m.id=r.member_id');

        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchall();
    }
}
