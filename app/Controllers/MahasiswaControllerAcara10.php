<?php
$rootPath = dirname(__DIR__, 2);
require_once $rootPath . '/app/Core/BaseController.php';
require_once $rootPath . '/app/Models/MahasiswaRepositoryAcara10.php';

class MahasiswaControllerAcara10 extends BaseController
{
    private $repository;

    public function __construct(MahasiswaRepositoryAcara10 $repository)
    {
        $this->repository = $repository;
    }

    public function index(): void
    {
        // Mengambil data melalui Repository Pattern
        $mahasiswa = $this->repository->all();

        // Menggunakan method view() yang diwarisi dari BaseController (Inheritance)
        $this->view('mahasiswa/index', [
            'title' => 'Daftar Mahasiswa - Acara 10',
            'mahasiswa' => $mahasiswa
        ]);
    }
}
?>