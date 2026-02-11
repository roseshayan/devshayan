<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

final class Database
{
    private static ?PDO $pdo = null;
    public static function pdo(): PDO
    {
        if (self::$pdo) return self::$pdo;
        $driver = $_ENV['DB_DRIVER'] ?? 'mysql';
        $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $db = $_ENV['DB_NAME'] ?? 'devshayan';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? '';
        $charset = 'utf8mb4';
        $dsn = $driver === 'mysql'
            ? "mysql:host={$host};port={$port};dbname={$db};charset={$charset}"
            : "sqlite:" . ($db ?: dirname(__DIR__, 2) . "/database.sqlite");
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        self::$pdo = new PDO($dsn, $user, $pass, $opt);
        return self::$pdo;
    }
}
