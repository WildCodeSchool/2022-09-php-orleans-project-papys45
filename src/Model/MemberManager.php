<?php

namespace App\Model;

use PDO;

class MemberManager extends AbstractManager
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

    public function selectOneByRole(string $role): array|false
    {
        $statement = $this->pdo->prepare("SELECT `role` FROM " . self::TABLE . " WHERE role=:role");
        $statement->bindValue('role', $role, \PDO::PARAM_STR);

        $statement->execute();

        return $statement->fetch();
    }

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
