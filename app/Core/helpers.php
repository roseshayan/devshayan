<?php

declare(strict_types=1);
// کامنت‌ها فارسی، خروجی سایت انگلیسی
function e(mixed $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
function redirect(string $to): void
{
    header('Location: ' . $to, true, 302);
    exit;
}
