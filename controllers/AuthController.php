<?php

declare(strict_types=1);

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (!empty($_SESSION['user'])) {
            $this->redirect('/?route=products');
        }

        $this->view('auth/login', [
            'title' => 'Iniciar sesión',
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function login(): void
    {
        $this->validateCsrf();

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?: '';
        $password = $_POST['password'] ?? '';

        $this->withOldInput(['email' => $email]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
            $this->setFlash('error', 'Ingresa un correo válido y una contraseña.');
            $this->redirect('/?route=login');
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $this->setFlash('error', 'Credenciales inválidas.');
            $this->redirect('/?route=login');
        }

        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];

        $this->clearOldInput();
        $this->setFlash('success', 'Bienvenido al panel administrativo.');
        $this->redirect('/?route=products');
    }

    public function logout(): void
    {
        $this->validateCsrf();
        unset($_SESSION['user']);
        session_regenerate_id(true);
        $this->setFlash('success', 'Sesión cerrada correctamente.');
        $this->redirect('/?route=login');
    }
}
