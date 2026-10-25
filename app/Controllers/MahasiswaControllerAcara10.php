<?php
require_once __DIR__ . '/BaseController.php';

class MahasiswaControllerAcara10 extends BaseController
{
    private MahasiswaRepositoryAcara10 $repo;

    public function __construct(MahasiswaRepositoryAcara10 $repo)
    {
        $this->repo = $repo;
    }

    // TAMPIL
    public function index(string $pesan = ''): void
    {
        $this->view('mahasiswa/index_acara10', [
            'mahasiswa' => $this->repo->all(),
            'pesan'     => $pesan,
        ]);
    }

    // TAMBAH
    public function store(): void
    {
        try {
            $m = new Mahasiswa($_POST['nim'] ?? '', $_POST['nama'] ?? '', $_POST['prodi'] ?? '');
            $this->repo->create($m);
            $this->redirect('index_acara10.php');
        } catch (Exception $e) {
            $this->index($e->getMessage());
        }
    }

    // FORM UBAH
    public function edit(string $nim): void
    {
        $m = $this->repo->find($nim);
        if ($m === null) {
            $this->index('Data tidak ditemukan');
            return;
        }
        $this->view('mahasiswa/edit_acara10', ['m' => $m]);
    }

    // UBAH
    public function update(): void
    {
        try {
            $m = $this->repo->find($_POST['nim'] ?? '');
            if ($m === null) {
                throw new Exception('Data tidak ditemukan');
            }
            $m->setNama($_POST['nama'] ?? '');
            $m->setProdi($_POST['prodi'] ?? '');
            $this->repo->update($m);
            $this->redirect('index_acara10.php');
        } catch (Exception $e) {
            $this->index($e->getMessage());
        }
    }

    // HAPUS
    public function destroy(): void
    {
        $this->repo->delete($_POST['nim'] ?? '');
        $this->redirect('index_acara10.php');
    }
}