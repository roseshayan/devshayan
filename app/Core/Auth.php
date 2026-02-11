<?php

declare(strict_types=1);

namespace App\Core;

final class Auth
{
    public static function check(): bool
    {
        return (bool)Session::get('user_id');
    }
    public static function id(): ?int
    {
        $v = Session::get('user_id');
        return $v ? (int)$v : null;
    }
    public static function role(): ?string
    {
        $v = Session::get('user_role');
        return $v ? (string)$v : null;
    }
    public static function name(): ?string
    {
        $v = Session::get('user_name');
        return $v ? (string)$v : null;
    }
    public static function login(string $email, string $password): bool
    {
        $pdo = Database::pdo();
        $st = $pdo->prepare("SELECT id,name,email,password_hash,role FROM users WHERE email=? LIMIT 1");
        $st->execute([$email]);
        $u = $st->fetch();
        if (!$u || !password_verify($password, (string)$u['password_hash'])) return false;
        Session::regenerate();
        Session::set('user_id', (int)$u['id']);
        Session::set('user_role', (string)$u['role']);
        Session::set('user_name', (string)$u['name']);
        return true;
    }
    public static function logout(): void
    {
        Session::forget('user_id');
        Session::forget('user_role');
        Session::forget('user_name');
        Session::regenerate();
    }
    public static function requireLogin(): void
    {
        if (self::check()) return;
        redirect('/admin/login');
    }
    public static function requireRole(array $roles): void
    {
        self::requireLogin();
        $r = self::role();
        if (!$r || !in_array($r, $roles, true)) {
            http_response_code(403);
            exit('403 | Forbidden');
        }
    }
    public static function isAdmin(): bool
    {
        return self::role() === 'admin';
    }
}
