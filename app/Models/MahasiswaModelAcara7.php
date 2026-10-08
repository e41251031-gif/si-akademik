<?php

require_once __DIR__ . '/../../config/database.php'; // Sesuaikan path file database kamu

class MahasiswaModelAcara7 {
    private $conn;
    private $table_name = "mahasiswa";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}