<?php

namespace App\Model;

use PDO;
use App\Model\MemberManager;

class RegisterManager extends AbstractManager
{
    public const TABLE = 'register';

    public function selectByRouteId(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT photo FROM " . MemberManager::TABLE . " AS m
       INNER JOIN " . self::TABLE . " AS r on m.id= r.member_id 
       WHERE r.route_id=:id");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
