<?php
declare(strict_types=1);
namespace App\Core;
final class Session{
  public static function start(): void{
    if(session_status()===PHP_SESSION_NONE){
      session_name($_ENV['SESSION_NAME']??'DEVSHAYANSESSID');
      session_start();
    }
  }
  public static function get(string $k,mixed $d=null): mixed{ return $_SESSION[$k]??$d; }
  public static function set(string $k,mixed $v): void{ $_SESSION[$k]=$v; }
  public static function forget(string $k): void{ unset($_SESSION[$k]); }
  public static function regenerate(): void{ session_regenerate_id(true); }
}
