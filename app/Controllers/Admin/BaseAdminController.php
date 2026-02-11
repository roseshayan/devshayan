<?php
declare(strict_types=1);
namespace App\Controllers\Admin;
use App\Core\Auth;
use App\Core\Session;
abstract class BaseAdminController{
  protected function start(): void{ Session::start(); }
  protected function guard(array $roles=['admin','editor']): void{ Auth::requireRole($roles); }
  protected function guardAdmin(): void{ Auth::requireRole(['admin']); }
}
