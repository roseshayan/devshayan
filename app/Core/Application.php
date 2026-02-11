<?php

declare(strict_types=1);

namespace App\Core;

final class Application
{
    public function __construct(private Router $router) {}
    public function run(): void
    {
        try {
            $this->router->dispatch();
        } catch (\Throwable $e) {
            error_log((string)$e);
            http_response_code(500);
            echo '500 | Server Error';
        }
    }
}
