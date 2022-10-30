<?php

namespace App\Model;

use PDO;

class AdminMembersManager extends AbstractManager
{
    public const TABLE = 'member';

    public function update(array $member): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET 
            `firstname` = :firstname,
            `lastname` = :lastname,
            `dateOfBirth` = :dateOfBirth,
            `role` = :role,
            `mail` = :mail,
            `photo` = :photo
            WHERE id=:id");
        $statement->bindValue('id', $member['id'], PDO::PARAM_INT);
        $statement->bindValue('firstname', $member['firstname'], PDO::PARAM_STR);
        $statement->bindValue('lastname', $member['lastname'], PDO::PARAM_STR);
        $statement->bindValue('dateOfBirth', $member['dateOfBirth'], PDO::PARAM_STR);
        $statement->bindValue('role', $member['role'], PDO::PARAM_STR);
        $statement->bindValue('mail', $member['mail'], PDO::PARAM_STR);
        $statement->bindValue('photo', $member['photo'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
