<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Core\Database;
final class SettingsRepository{
  public static function all(): array{
    $pdo=Database::pdo();
    $rows=$pdo->query("SELECT `key`,`value` FROM settings")->fetchAll();
    $out=[];
    foreach($rows as $r){ $out[(string)$r['key']]=(string)$r['value']; }
    return $out;
  }
  public static function get(string $key,?string $default=null): ?string{
    $pdo=Database::pdo();
    $st=$pdo->prepare("SELECT `value` FROM settings WHERE `key`=? LIMIT 1");
    $st->execute([$key]);
    $v=$st->fetchColumn();
    return $v!==false?(string)$v:$default;
  }
  public static function setMany(array $kv): void{
    if(!$kv) return;
    $pdo=Database::pdo();
    $pdo->beginTransaction();
    $st=$pdo->prepare("INSERT INTO settings(`key`,`value`) VALUES(?,?) ON DUPLICATE KEY UPDATE `value`=VALUES(`value`)");
    foreach($kv as $k=>$v){ $st->execute([(string)$k,(string)$v]); }
    $pdo->commit();
  }
}
