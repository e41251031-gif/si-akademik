<?php
$rootPath = dirname(__DIR__);

require_once $rootPath . '/config/database.php';
require_once $rootPath . '/app/Models/MahasiswaRepositoryAcara10.php';
require_once $rootPath . '/app/Controllers/MahasiswaControllerAcara10.php';

try {
    $database   = new Database();                                // 1. koneksi PDO
    $repository = new MahasiswaRepositoryAcara10($database);     // 2. inject Database
    $controller = new MahasiswaControllerAcara10($repository);   // 3. inject Repository

    $aksi = $_GET['aksi'] ?? 'index';

    switch ($aksi) {
        case 'simpan': $controller->store(); break;
        case 'edit':   $controller->edit($_GET['nim'] ?? ''); break;
        case 'ubah':   $controller->update(); break;
        case 'hapus':  $controller->destroy(); break;
        default:       $controller->index();
    }
} catch (Exception $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}