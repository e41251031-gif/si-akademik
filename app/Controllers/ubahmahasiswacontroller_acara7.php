<?php

require_once __DIR__ . '/../Models/MahasiswaModel.php';

class MahasiswaController
{
    public function index()
    {
        // Panggil model untuk mengambil data dari database
        $model = new MahasiswaModel();
        $dataMahasiswa = $model->all();

        // Panggil view untuk menampilkan tabel
        require_once __DIR__ . '/../Views/mahasiswa/index.php';
    }

    public function create()
    {
        echo "Halaman Tambah Mahasiswa";
    }

    public function show($id)
    {
        echo "Detail Mahasiswa dengan ID: " . $id;
    }
}