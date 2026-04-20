<?php

declare(strict_types=1);

class AuthMiddleware
{
    public function handle(): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Debes iniciar sesión para acceder al panel.',
            ];

            $prefix = defined('BASE_URL') ? BASE_URL : '';
            header('Location: ' . $prefix . '/?route=login');
            exit;
        }
    }
}
