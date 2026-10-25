<?php
// Menggunakan jalur absolut dari lokasi file ini agar tidak salah folder
$rootPath = dirname(__DIR__); // Ini akan otomatis mengarah ke folder "si-akademik"

require_once $rootPath . '/config/database.php';
require_once $rootPath . '/app/Models/MahasiswaRepositoryAcara9.php';
require_once $rootPath . '/app/Controllers/MahasiswaControllerAcara9.php';

try {
    // 1. Instansiasi objek Database
    $database = new Database();

    // 2. Masukkan Database ke Repository (Dependency Injection & Object Composition)
    $repository = new MahasiswaRepositoryAcara9($database);

    // 3. Masukkan Repository ke Controller
    $controller = new MahasiswaControllerAcara9($repository);

    // 4. Jalankan method sesuai aksi (tampil, tambah, ubah, hapus)
    $aksi = $_GET['aksi'] ?? 'index';

    switch ($aksi) {
        case 'simpan':
            $controller->store();
            break;
        case 'edit':
            $controller->edit($_GET['nim'] ?? '');
            break;
        case 'ubah':
            $controller->update();
            break;
        case 'hapus':
            $controller->destroy();
            break;
        default:
            $controller->index();
    }

} catch (Exception $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
?>