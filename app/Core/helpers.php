<?php

declare(strict_types=1);
// توابع کمکی عمومی پروژه
function e(mixed $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
