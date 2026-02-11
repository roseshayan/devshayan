<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $params = [], string $layout = 'layout'): string
    {
        $viewPath = dirname(__DIR__, 2) . "/resources/views/{$view}.php";
        $layoutPath = dirname(__DIR__, 2) . "/resources/views/{$layout}.php";
        if (!is_file($viewPath) || !is_file($layoutPath)) return 'View not found';
        extract($params, EXTR_SKIP);
        ob_start();
        require $viewPath;
        $content = ob_get_clean();
        ob_start();
        require $layoutPath;
        return (string)ob_get_clean();
    }
}
