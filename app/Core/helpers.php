<?php
declare(strict_types=1);
// توابع کمکی پروژه
function e(mixed $v): string{ return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8'); }
function redirect(string $to): void{ header('Location: '.$to,true,302); exit; }
// تولید اسلاگ ساده (انگلیسی)
function slugify(string $s): string{
  $s=strtolower(trim($s));
  $s=preg_replace('~[^a-z0-9]+~','-',$s)??'';
  $s=trim($s,'-');
  return $s!==''?$s:'post';
}
// CSRF
function csrf_token(): string{
  \App\Core\Session::start();
  $t=(string)\App\Core\Session::get('_csrf','');
  if($t===''){ $t=bin2hex(random_bytes(16)); \App\Core\Session::set('_csrf',$t); }
  return $t;
}
function csrf_field(): string{ return '<input type="hidden" name="_token" value="'.e(csrf_token()).'">'; }
function csrf_verify(): void{
  \App\Core\Session::start();
  $sent=(string)($_POST['_token']??'');
  $real=(string)\App\Core\Session::get('_csrf','');
  if($sent===''||$real===''||!hash_equals($real,$sent)){ http_response_code(419); exit('419 | CSRF'); }
}
