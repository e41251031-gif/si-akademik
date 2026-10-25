<?php
// Mundur dari app/Models ke folder utama, lalu masuk ke config
require_once __DIR__ . '/../../config/database_acara14.php';

class MahasiswaRepositoryAcara14 {
    private $db;

    public function __construct() {
        // Sesuaikan dengan nama class asli (biasanya Database_Acara14)
        $this->db = Database_Acara14::getInstance();
    }
    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function existsByNim($nim, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim AND id != :id");
            $stmt->execute(['nim' => $nim, 'id' => $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim");
            $stmt->execute(['nim' => $nim]);
        }
        return $stmt->fetchColumn() > 0;
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, email, angkatan) VALUES (:nim, :nama, :email, :angkatan)");
        return $stmt->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'angkatan' => $data['angkatan']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, angkatan = :angkatan WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'angkatan' => $data['angkatan']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}