<?php

class Mahasiswa
{
    private string $nim;
    private string $nama;
    private string $prodi;

    public function __construct(string $nim, string $nama, string $prodi)
    {
        $this->setNim($nim);
        $this->setNama($nama);
        $this->prodi = $prodi;
    }

    // Getter
    public function getNim(): string
    {
        return $this->nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getProdi(): string
    {
        return $this->prodi;
    }

    public function angkatan(): string
    {
        return substr($this->nim, 3, 2);
    }

    // Setter dengan Validasi (Sesuai Modul Acara 9)
    public function setNim(string $nim): void
    {
        if (!is_numeric($nim)) {
            throw new Exception("NIM harus berupa angka!");
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        if (empty(trim($nama))) {
            throw new Exception("Nama mahasiswa tidak boleh kosong!");
        }
        $this->nama = $nama;
    }

    public function setProdi(string $prodi): void
    {
        $this->prodi = $prodi;
    }
}