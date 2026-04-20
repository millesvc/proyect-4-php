<?php

declare(strict_types=1);

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo 'Vista no encontrada.';
            exit;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require $viewPath;
        require __DIR__ . '/../views/layouts/footer.php';
    }

    protected function redirect(string $path): void
    {
        $prefix = defined('BASE_URL') ? BASE_URL : '';
        header('Location: ' . $prefix . $path);
        exit;
    }

    protected function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    protected function csrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    protected function validateCsrf(): void
    {
        $token = $_POST['_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';

        if (!$token || !$sessionToken || !hash_equals($sessionToken, $token)) {
            http_response_code(419);
            exit('Token CSRF inválido.');
        }
    }

    protected function old(string $key, string $default = ''): string
    {
        return htmlspecialchars($_SESSION['old'][$key] ?? $default, ENT_QUOTES, 'UTF-8');
    }

    protected function withOldInput(array $input): void
    {
        $_SESSION['old'] = $input;
    }

    protected function clearOldInput(): void
    {
        unset($_SESSION['old']);
    }
}
