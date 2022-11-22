<?php

namespace App\Model;

use PDO;

class ActualityManager extends AbstractManager
{
    public const TABLE = 'actuality';

    public function add(array $actuality): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
                "(`title`,`content`)
            VALUES
            (:title, :content)"
        );
        $statement->bindValue('title', $actuality['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $actuality['content'], PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function selectOneById(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function update(array $actuality): bool
    {

        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET
        `title` = :title,
        `content` = :content
        WHERE id=:id");
        $statement->bindValue('id', $actuality['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $actuality['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $actuality['content'], PDO::PARAM_STR);
        return $statement->execute();
    }
}
