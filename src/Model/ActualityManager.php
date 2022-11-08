<?php

namespace App\Model;

use PDO;

class ActualityManager extends AbstractManager
{
    public const TABLE = 'actuality';

    public function update(array $actuality): bool
    {
        $statement = $this->pdo->prepare("UPDATE" . self::TABLE .
        "SET `title`=:title, `content`=:content
        WHERE id=:id");

        $statement->bindValue('id', $actuality['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $actuality['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $actuality['content'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
