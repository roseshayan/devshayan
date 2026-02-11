<?php
declare(strict_types=1);
namespace App\Core;
use PDO;
final class Database{
  private static ?PDO $pdo=null;
  public static function pdo(): PDO{
    if(self::$pdo) return self::$pdo;
    $driver=$_ENV['DB_DRIVER']??'mysql';
    if($driver==='sqlite'){
      $file=$_ENV['DB_NAME']??dirname(__DIR__,2).'/storage/devshayan.sqlite';
      if(!is_dir(dirname($file))) mkdir(dirname($file),0775,true);
      $dsn='sqlite:'.$file;
      self::$pdo=new PDO($dsn,null,null,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
      self::$pdo->exec('PRAGMA foreign_keys=ON');
      return self::$pdo;
    }
    $host=$_ENV['DB_HOST']??'127.0.0.1';
    $port=$_ENV['DB_PORT']??'3306';
    $db=$_ENV['DB_NAME']??'devshayan';
    $user=$_ENV['DB_USER']??'root';
    $pass=$_ENV['DB_PASS']??'';
    $dsn="mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
    self::$pdo=new PDO($dsn,$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]);
    return self::$pdo;
  }
}
