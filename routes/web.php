<?php

$routes = [
    '/' => ['HomeController', 'index'],
    '/mahasiswa' => ['MahasiswaController', 'index'],
    '/mahasiswa/create' => ['MahasiswaController', 'create'],
    '/mahasiswa/{id}' => ['MahasiswaController', 'show'],

    // Acara 6 - Authentication
    '/login' => ['AuthController', 'loginForm'],
    '/login/process' => ['AuthController', 'login'],
    '/logout' => ['AuthController', 'logout'],
    '/dashboard' => ['HomeController', 'dashboard'],
];