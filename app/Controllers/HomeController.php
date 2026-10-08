<?php

class HomeController
{
    public function index()
    {
        echo "Halaman Home";
    }

    public function dashboard()
    {
        require __DIR__ . '/../Views/dashboard.php';
    }
}