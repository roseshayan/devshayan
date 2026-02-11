<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\View;
use App\Core\Session;

final class AuthController
{
    public function loginForm(): string
    {
        Session::start();
        return View::render('admin/login', ['title' => 'Admin Login'], 'admin/auth');
    }
    public function login(): string
    {
        Session::start();
        $email = trim((string)($_POST['email'] ?? ''));
        $pass = (string)($_POST['password'] ?? '');
        if (!Auth::login($email, $pass)) return View::render('admin/login', ['title' => 'Admin Login', 'error' => 'Invalid credentials'], 'admin/auth');
        redirect('/admin');
    }
    public function logout(): string
    {
        Session::start();
        Auth::logout();
        redirect('/admin/login');
    }
}
