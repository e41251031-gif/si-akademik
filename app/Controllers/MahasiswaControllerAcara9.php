<?php
class MahasiswaControllerAcara9 {
    private $repository;

    // Dependency Injection untuk Repository
    public function __construct($repository) {
        $this->repository = $repository;
    }

    public function index() {
        $mahasiswa = $this->repository->getAllMahasiswa();
        
        // Tampilan sederhana untuk pengujian Acara 9
        echo "<h2>Data Mahasiswa - Acara 9 (Dependency Injection & Object Composition)</h2>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>NIM</th><th>Nama</th></tr>";
        foreach ($mahasiswa as $mhs) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($mhs['nim']) . "</td>";
            echo "<td>" . htmlspecialchars($mhs['nama']) . "</td>";
            echo "<tr>";
        }
        echo "</table>";
    }
}
?>