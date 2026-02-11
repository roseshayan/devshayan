<?php
declare(strict_types=1);
require dirname(__DIR__).'/vendor/autoload.php';
$dotenv=Dotenv\Dotenv::createImmutable(dirname(__DIR__));
if(is_file(dirname(__DIR__).'/.env')) $dotenv->load();
use App\Core\Database;
$sqls=require dirname(__DIR__).'/database/migrations.php';
$pdo=Database::pdo();
foreach($sqls as $sql){ $pdo->exec($sql); }
echo "MIGRATED\n";
