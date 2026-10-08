<?php

require_once __DIR__ . '/../Models/MahasiswaModel.php';

class MahasiswaController {
    private MahasiswaModel $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
    }

    public function index(): void {
        $search = $_GET['search'] ?? '';
        $mahasiswa = $this->model->all($search);
        require_once __DIR__ . '/../views/mahasiswa/index.php';
    }

    public function create(): void {
        require_once __DIR__ . '/../views/mahasiswa/create.php';
    }

    public function store(): void {
        $nim      = trim($_POST['nim'] ?? '');
        $nama     = trim($_POST['nama'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);
        $angkatan = (int)($_POST['angkatan'] ?? date('Y'));
        $status   = $_POST['status'] ?? 'aktif';

        if (empty($nim) || empty($nama)) {
            header('Location: /si-akademik/public/mahasiswa');
            exit;
        }

        $this->model->create([
            'nim'      => $nim,
            'nama'     => $nama,
            'email'    => $email,
            'prodi_id' => $prodi_id,
            'angkatan' => $angkatan,
            'status'   => $status
        ]);

        header('Location: /si-akademik/public/mahasiswa');
        exit;
    }

    public function destroy(): void {
        $nim = $_POST['nim'] ?? '';
        if (!empty($nim)) {
            $this->model->delete($nim);
        }
        header('Location: /si-akademik/public/mahasiswa');
        exit;
    }
}