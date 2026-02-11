<?php
declare(strict_types=1);
namespace App\Core;
final class Router{
  private array $routes=['GET'=>[],'POST'=>[]];
  private Request $request;
  public function __construct(){ $this->request=new Request(); }
  public function get(string $path,array $handler): void{ $this->routes['GET'][]=['p'=>$path,'h'=>$handler,'r'=>$this->compile($path)]; }
  public function post(string $path,array $handler): void{ $this->routes['POST'][]=['p'=>$path,'h'=>$handler,'r'=>$this->compile($path)]; }
  private function compile(string $path): ?string{
    if(strpos($path,'{')===false) return null;
    $rx=preg_replace('~\{([a-zA-Z_][a-zA-Z0-9_]*)\}~','(?P<$1>[^/]+)',$path);
    return '~^'.rtrim((string)$rx,'/').'$~';
  }
  public function dispatch(): void{
    $method=$this->request->method();
    $path=$this->request->path();
    foreach($this->routes[$method] as $r){
      if($r['r']===null){
        if($r['p']!==$path) continue;
        $this->invoke($r['h'],[]);
        return;
      }
      if(preg_match((string)$r['r'],$path,$m)){
        $params=[];
        foreach($m as $k=>$v) if(!is_int($k)) $params[]=$v;
        $this->invoke($r['h'],$params);
        return;
      }
    }
    http_response_code(404);
    echo '404 | Not Found';
  }
  private function invoke(array $handler,array $params): void{
    [$class,$action]=$handler;
    $c=new $class();
    echo $c->$action(...$params);
  }
}
