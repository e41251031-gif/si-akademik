<?php

class BaseController
{
    // Menampilkan file view dan mengirim data ke dalamnya
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../Views/' . $view . '.php';
    }

    // Mengarahkan pengguna ke halaman lain
    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}