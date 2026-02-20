<?php

declare(strict_types=1);

namespace App\P05\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private static ?self $instance = null;

    private PDO $pdo;

    private function __construct()
    {
        try {
            $dbPath = __DIR__.'/../../../../database/database.sqlite';
            if (! file_exists($dbPath)) {
                require_once __DIR__.'/../../../../database/pdo.php';
                global $pdo;
                $this->pdo = $pdo;
            } else {
                $this->pdo = new PDO('sqlite:'.$dbPath);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            exit('Database Connection Error: '.$e->getMessage());
        }
    }

    private static function getInternalInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = self::getInternalInstance()->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    public static function getAll(string $sql, array $params = []): array
    {
        return self::query($sql, $params)->fetchAll();
    }

    public static function getOne(string $sql, array $params = []): ?array
    {
        $result = self::query($sql, $params)->fetch();

        return $result ?: null;
    }

    public static function lastInsertId(): string
    {
        return (string) self::getInternalInstance()->pdo->lastInsertId();
    }
}
