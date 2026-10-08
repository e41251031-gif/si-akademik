<?php

class Mahasiswa
{
    public $nim;
    public $nama;
    public $prodi;

    public function __construct($nim, $nama, $prodi)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->prodi = $prodi;
    }

    public function angkatan()
    {
        return substr($this->nim, 1, 2);
    }
}

$mahasiswa = [
    new Mahasiswa("E41251031", "Siti Maisyaroh", "Teknik Informatika"),
    new Mahasiswa("E41251032", "Mahasiswa Contoh", "Teknik Informatika")
];

include "../app/Views/mahasiswa/index.php";