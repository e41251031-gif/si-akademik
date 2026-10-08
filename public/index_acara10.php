<?php
$rootPath = dirname(__DIR__);

require_once $rootPath . '/config/database.php';
require_once $rootPath . '/app/Models/MahasiswaRepositoryAcara10.php';
require_once $rootPath . '/app/Controllers/MahasiswaControllerAcara10.php';

try {
    // 1. Instansiasi Database
    $database = new Database();

    // 2. Instansiasi Repository dengan Dependency Injection
    $repository = new MahasiswaRepositoryAcara10($database);

    // 3. Instansiasi Controller dengan Repository
    $controller = new MahasiswaControllerAcara10($repository);

    // 4. Jalankan method index
    $controller->index();

} catch (Exception $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
?>