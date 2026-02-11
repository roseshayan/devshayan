<?php

declare(strict_types=1);
require dirname(__DIR__) . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
if (is_file(dirname(__DIR__) . '/.env')) $dotenv->load();

use App\Core\Database;

$pdo = Database::pdo();
$adminEmail = $_ENV['ADMIN_EMAIL'] ?? 'admin@devshayan.local';
$adminPass = $_ENV['ADMIN_PASSWORD'] ?? 'admin1234';
$editorEmail = $_ENV['EDITOR_EMAIL'] ?? 'editor@devshayan.local';
$editorPass = $_ENV['EDITOR_PASSWORD'] ?? 'editor1234';
$ins = function (string $name, string $email, string $pass, string $role) use ($pdo) {
    $st = $pdo->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
    $st->execute([$email]);
    if ($st->fetch()) return;
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $st = $pdo->prepare("INSERT INTO users(name,email,password_hash,role) VALUES(?,?,?,?)");
    $st->execute([$name, $email, $hash, $role]);
};
$ins('Admin', $adminEmail, $adminPass, 'admin');
$ins('Editor', $editorEmail, $editorPass, 'editor');
echo "SEEDED\n";
