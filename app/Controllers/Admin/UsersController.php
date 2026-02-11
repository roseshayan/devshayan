<?php
declare(strict_types=1);
namespace App\Controllers\Admin;
use App\Core\Database;
use App\Core\View;
final class UsersController extends BaseAdminController{
  public function index(): string{
    $this->start(); $this->guardAdmin();
    $pdo=Database::pdo();
    $users=$pdo->query("SELECT id,name,email,role,created_at FROM users ORDER BY id ASC")->fetchAll();
    return View::render('admin/users',['title'=>'Users','users'=>$users],'admin/layout');
  }
  public function create(): string{
    $this->start(); $this->guardAdmin(); csrf_verify();
    $name=trim((string)($_POST['name']??''));
    $email=trim((string)($_POST['email']??''));
    $pass=(string)($_POST['password']??'');
    $role=(string)($_POST['role']??'editor');
    if($name===''||$email===''||$pass===''||!in_array($role,['admin','editor'],true)) redirect('/admin/users');
    $hash=password_hash($pass,PASSWORD_DEFAULT);
    $pdo=Database::pdo();
    $st=$pdo->prepare("INSERT INTO users(name,email,password_hash,role) VALUES(?,?,?,?)");
    try{ $st->execute([$name,$email,$hash,$role]); }catch(\Throwable $e){}
    redirect('/admin/users');
  }
}
