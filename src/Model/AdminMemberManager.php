<?php

namespace App\Model;

use PDO;

class AdminMemberManager extends AbstractManager
{
    public const TABLE = 'member';

    public function insert(array $member): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
                "(`firstname`,`lastname`,`dateOfBirth`,`role`,`mail`,`photo`) 
            VALUES 
            (:firstname, :lastname, :dateOfBirth, :role, :mail, :photo)"
        );
        $statement->bindValue('firstname', $member['firstname'], PDO::PARAM_STR);
        $statement->bindValue('lastname', $member['lastname'], PDO::PARAM_STR);
        $statement->bindValue('dateOfBirth', $member['dateOfBirth'], PDO::PARAM_STR);
        $statement->bindValue('role', $member['role'], PDO::PARAM_STR);
        $statement->bindValue('mail', $member['mail'], PDO::PARAM_STR);
        $statement->bindValue('photo', $member['photo'], PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
