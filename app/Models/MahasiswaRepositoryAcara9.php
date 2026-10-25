<?php
$rootPath = dirname(__DIR__, 2);
require_once $rootPath . '/config/database.php';
require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaRepositoryAcara9
{
    private $db;

    public function __construct(Database $databaseInstance)
    {
        $this->db = $databaseInstance;
    }

    private function pdo(): PDO
    {
        return $this->db->getConnection();
    }

    public function getAllMahasiswa(): array
    {
        $stmt = $this->pdo()->prepare("SELECT * FROM mahasiswa");
        $stmt->execute();

        $hasil = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $hasil[] = new Mahasiswa($row['nim'], $row['nama'], $row['prodi']);
        }
        return $hasil;
    }

    public function findByNim(string $nim): ?Mahasiswa
    {
        $stmt = $this->pdo()->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
        $stmt->execute([$nim]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Mahasiswa($row['nim'], $row['nama'], $row['prodi']) : null;
    }

    public function create(Mahasiswa $m): void
    {
        $stmt = $this->pdo()->prepare("INSERT INTO mahasiswa (nim, nama, prodi) VALUES (?, ?, ?)");
        $stmt->execute([$m->getNim(), $m->getNama(), $m->getProdi()]);
    }

    public function update(Mahasiswa $m): void
    {
        $stmt = $this->pdo()->prepare("UPDATE mahasiswa SET nama = ?, prodi = ? WHERE nim = ?");
        $stmt->execute([$m->getNama(), $m->getProdi(), $m->getNim()]);
    }

    public function delete(string $nim): void
    {
        $stmt = $this->pdo()->prepare("DELETE FROM mahasiswa WHERE nim = ?");
        $stmt->execute([$nim]);
    }
}