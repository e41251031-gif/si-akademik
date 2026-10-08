<?php

require_once __DIR__ . '/../../config/database.php';

class MahasiswaModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(string $search = ''): array {
        if (!empty($search)) {
            $stmt = $this->db->prepare("SELECT m.*, p.nama AS nama_prodi 
                                       FROM mahasiswa m 
                                       LEFT JOIN prodi p ON m.prodi_id = p.id 
                                       WHERE m.nama LIKE :search OR m.nim LIKE :search
                                       ORDER BY m.nim ASC");
            $stmt->execute(['search' => "%{$search}%"]);
        } else {
            $stmt = $this->db->query("SELECT m.*, p.nama AS nama_prodi 
                                     FROM mahasiswa m 
                                     LEFT JOIN prodi p ON m.prodi_id = p.id 
                                     ORDER BY m.nim ASC");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) 
                                   VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)");
        return $stmt->execute([
            'nim'      => $data['nim'],
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'prodi_id' => $data['prodi_id'],
            'angkatan' => $data['angkatan'],
            'status'   => $data['status']
        ]);
    }

    public function delete(string $nim): bool {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE nim = :nim");
        return $stmt->execute(['nim' => $nim]);
    }
}