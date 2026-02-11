<?php
declare(strict_types=1);
namespace App\Controllers\Admin;
use App\Core\Auth;
use App\Core\View;
final class DashboardController extends BaseAdminController{
  public function index(): string{
    $this->start(); $this->guard(['admin','editor']);
    return View::render('admin/dashboard',['title'=>'Dashboard','user'=>['name'=>Auth::name(),'role'=>Auth::role()]],'admin/layout');
  }
}
