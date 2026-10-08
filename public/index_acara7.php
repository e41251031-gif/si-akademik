<?php

require_once __DIR__ . '/../app/Controllers/MahasiswaControllerAcara7.php';

// Ambil path URI dan PATH_INFO
$uri = $_SERVER['REQUEST_URI'] ?? '';
$pathInfo = $_SERVER['PATH_INFO'] ?? '';

// Pengecekan route /mahasiswa
if (strpos($uri, 'mahasiswa') !== false || $pathInfo === '/mahasiswa') {
    $controller = new MahasiswaControllerAcara7();
    $controller->index();
} else {
    http_response_code(404);
    echo "404 - Halaman Acara 7 Tidak Ditemukan";
}