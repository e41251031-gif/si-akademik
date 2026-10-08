<?php
$rootPath = dirname(__DIR__, 2);
require_once $rootPath . '/config/database.php';

class MahasiswaRepositoryAcara10
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function all(): array
    {
        $conn = $this->db->getConnection();
        // Menggunakan p.nama sesuai struktur tabel prodi umum (ubah ke p.nama_prodi jika di database-mu namanya berbeda)
        $query = "SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m LEFT JOIN prodi p ON m.prodi_id = p.id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row : null;
    }

    public function create(array $data): int
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan) VALUES (:nim, :nama, :email, :prodi_id, :angkatan)");
        $stmt->execute($data);
        return (int) $conn->lastInsertId();
    }
}
?>