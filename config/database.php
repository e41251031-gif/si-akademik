<?php

class Database {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "si_akademik"; // Sesuaikan dengan nama database MySQL kamu

    // Constructor dibuat public agar 'new Database()' di Acara 7 tetap jalan
    public function __construct() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Koneksi Database Gagal: " . $e->getMessage();
            }
        }
    }

    // Method Singleton agar 'Database::getInstance()' di Acara 8 berjalan lancar
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Mengembalikan objek koneksi PDO
    public function getConnection() {
        return $this->conn;
    }
}