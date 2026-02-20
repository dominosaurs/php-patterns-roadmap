<?php

namespace App\P04\Core;

use PDO;
use PDOException;

/**
 * 🐘 Pattern: Singleton Database
 * Centralized database access with a single connection instance.
 */
class Database
{
    private static ?PDO $instance = null;

    /**
     * Get the PDO instance (Singleton)
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                // Determine database path
                $dbPath = __DIR__.'/../../../../database/database.sqlite';

                // If the database is missing, we still want the auto-migration logic
                // For this educational project, we'll trigger the shared pdo.php
                // just once to ensure migration runs if needed,
                // but then we'll own the instance.
                if (! file_exists($dbPath)) {
                    require_once __DIR__.'/../../../../database/pdo.php';
                    global $pdo;
                    self::$instance = $pdo;
                } else {
                    self::$instance = new PDO('sqlite:'.$dbPath);
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                }
            } catch (PDOException $e) {
                exit('Database Connection Error: '.$e->getMessage());
            }
        }

        return self::$instance;
    }

    /**
     * Helper to run queries easily
     */
    public static function query($sql, $params = [])
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    public static function getAll($sql, $params = [])
    {
        return self::query($sql, $params)->fetchAll();
    }

    public static function getOne($sql, $params = [])
    {
        return self::query($sql, $params)->fetch();
    }

    public static function lastInsertId()
    {
        return self::getInstance()->lastInsertId();
    }
}
