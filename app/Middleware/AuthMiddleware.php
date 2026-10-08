<?php

class AuthMiddleware
{
    public function handle()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (
            empty($_SESSION['logged_in']) ||
            $_SESSION['logged_in'] !== true
        ) {
            header('Location: /si-akademik/public/login');
            exit;
        }
    }
}