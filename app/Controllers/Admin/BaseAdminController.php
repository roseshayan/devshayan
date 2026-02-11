<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;

abstract class BaseAdminController
{
    protected function guard(array $roles = ['admin', 'editor']): void
    {
        Auth::requireRole($roles);
    }
    protected function guardAdmin(): void
    {
        Auth::requireRole(['admin']);
    }
}
