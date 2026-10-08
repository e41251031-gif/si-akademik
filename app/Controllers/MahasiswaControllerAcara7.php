<?php

require_once __DIR__ . '/../Models/MahasiswaModelAcara7.php';

class MahasiswaControllerAcara7 {
    public function index() {
        $model = new MahasiswaModelAcara7();
        $mahasiswa = $model->getAll();

        // Panggil View dan kirimkan data $mahasiswa
        require_once __DIR__ . '/../Views/mahasiswa/index_acara7.php';
    }
}