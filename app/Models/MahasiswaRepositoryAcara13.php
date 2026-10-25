<?php

namespace App\Models;

require_once __DIR__ . '/../../config/database.php';

use Database;
use PDO;

class MahasiswaRepositoryAcara13
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM mahasiswa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        // Pastikan prodi_id bernilai NULL jika kosong agar tidak error foreign key
        $prodiId = !empty($data['prodi_id']) ? $data['prodi_id'] : null;

        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, prodi_id) VALUES (:nim, :nama, :prodi_id)");
        $stmt->execute([
            'nim' => $data['nim'] ?? '',
            'nama' => $data['nama'] ?? '',
            'prodi_id' => $prodiId
        ]);
        return $this->db->lastInsertId();
    }

    public function update($id, array $data): bool
    {
        $prodiId = !empty($data['prodi_id']) ? $data['prodi_id'] : null;

        $stmt = $this->db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, prodi_id = :prodi_id WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nim' => $data['nim'] ?? '',
            'nama' => $data['nama'] ?? '',
            'prodi_id' => $prodiId
        ]);
    }

    public function existsByNim(string $nim, $excludeId = null): bool
    {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim AND id != :id");
            $stmt->execute(['nim' => $nim, 'id' => $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim");
            $stmt->execute(['nim' => $nim]);
        }
        return $stmt->fetchColumn() > 0;
    }
}