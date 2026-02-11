<?php
declare(strict_types=1);
namespace App\Core;
final class View{
  public static function render(string $view,array $params=[],string $layout='layout'): string{
    $vp=dirname(__DIR__,2)."/resources/views/{$view}.php";
    $lp=dirname(__DIR__,2)."/resources/views/{$layout}.php";
    if(!is_file($vp)||!is_file($lp)) return 'View not found';
    extract($params,EXTR_SKIP);
    ob_start(); require $vp; $content=ob_get_clean();
    ob_start(); require $lp; return (string)ob_get_clean();
  }
}
