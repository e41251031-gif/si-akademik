<?php

namespace App\Models;

use PDO;

class ProdiRepository
{
    private $db;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'si_akademik'; // Sesuaikan nama database Anda
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }

    // Ambil semua data Program Studi
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM prodi");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cari prodi berdasarkan ID
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM prodi WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}