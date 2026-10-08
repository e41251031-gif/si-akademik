<?php

require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Membersihkan base path dan nama file index_acara8.php dari URI
$uri = str_replace('/si-akademik/public/index_acara8.php', '', $uri);
$uri = str_replace('/si-akademik/public', '', $uri);

// Default route ke /mahasiswa jika URI kosong atau hanya '/'
if ($uri === '' || $uri === '/') {
    $uri = '/mahasiswa';
}

$controller = new MahasiswaController();

// Simple Router Acara 8
if ($method === 'GET' && $uri === '/mahasiswa') {
    $controller->index();
} elseif ($method === 'GET' && $uri === '/mahasiswa/create') {
    $controller->create();
} elseif ($method === 'POST' && $uri === '/mahasiswa/store') {
    $controller->store();
} elseif ($method === 'POST' && $uri === '/mahasiswa/destroy') {
    $controller->destroy();
} else {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";
}