<?php

class AuthController
{
    public function loginForm()
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === '12345') {

            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = 'Admin';

            header('Location: /si-akademik/public/dashboard');
            exit;
        }

        echo "Username atau password salah.";
    }

    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_destroy();

        echo "Anda telah logout.";
    }
}