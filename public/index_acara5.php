<?php

// Ambil data URL dari REQUEST_URI maupun PATH_INFO
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$pathInfo   = $_SERVER['PATH_INFO'] ?? '';

// Bersihkan path agar mudah dicek
$path = parse_url($requestUri, PHP_URL_PATH);
$path = strtolower($path);
$pathInfo = strtolower($pathInfo);

// ==========================================
// ROUTER TERPADU (ACARA 5)
// ==========================================

// 1. Route Tambah Mahasiswa (/mahasiswa/create)
if (strpos($path, '/mahasiswa/create') !== false || strpos($pathInfo, '/mahasiswa/create') !== false) {
    
    echo "<h1>Halaman Tambah Mahasiswa</h1>";
    echo "<p>Form tambah data mahasiswa baru.</p>";

// 2. Route Detail Mahasiswa dengan ID (contoh: /mahasiswa/5)
} elseif (preg_match('/\/mahasiswa\/(\d+)/', $path, $matches) || preg_match('/\/mahasiswa\/(\d+)/', $pathInfo, $matches)) {
    
    $id = $matches[1];
    echo "<h1>Detail Mahasiswa dengan ID: " . htmlspecialchars($id) . "</h1>";
    echo "<p>Menampilkan informasi lengkap mahasiswa ID " . htmlspecialchars($id) . ".</p>";

// 3. Route Daftar Mahasiswa (/mahasiswa)
} elseif (
    strpos($path, '/mahasiswa') !== false || 
    strpos($pathInfo, '/mahasiswa') !== false
) {
    
    echo "<h1>Halaman Mahasiswa</h1>";
    echo "<p>Daftar seluruh data mahasiswa.</p>";

// 4. Route Home / Dashboard Utam
} elseif (
    $pathInfo === '' || 
    $pathInfo === '/' || 
    substr($path, -16) === 'index_acara5.php' || 
    substr($path, -17) === 'index_acara5.php/'
) {
    
    echo "<h1>Selamat Datang di Halaman Home</h1>";
    echo "<p>Sistem Informasi Akademik (Acara 5)</p>";

// 5. Route 404 (Halaman Tidak Ditemukan)
} else {
    
    http_response_code(404);
    echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
}