<?php
require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaRepositoryAcara10 extends BaseModel
{
    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM mahasiswa ORDER BY nim");

        $hasil = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            try {
                $hasil[] = new Mahasiswa($row['nim'], $row['nama'], $row['prodi'] ?? '-');
            } catch (InvalidArgumentException $e) {
                continue; // lewati data yang tidak lolos validasi setter
            }
        }
        return $hasil;
    }

    public function find(string $nim): ?Mahasiswa
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
        $stmt->execute(['nim' => $nim]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Mahasiswa($row['nim'], $row['nama'], $row['prodi'] ?? '-') : null;
    }

    public function create(Mahasiswa $m): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO mahasiswa (nim, nama, prodi) VALUES (:nim, :nama, :prodi)"
        );
        $stmt->execute([
            'nim'   => $m->getNim(),
            'nama'  => $m->getNama(),
            'prodi' => $m->getProdi(),
        ]);
    }

    public function update(Mahasiswa $m): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE mahasiswa SET nama = :nama, prodi = :prodi WHERE nim = :nim"
        );
        $stmt->execute([
            'nama'  => $m->getNama(),
            'prodi' => $m->getProdi(),
            'nim'   => $m->getNim(),
        ]);
    }

    public function delete(string $nim): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM mahasiswa WHERE nim = :nim");
        $stmt->execute(['nim' => $nim]);
    }
}