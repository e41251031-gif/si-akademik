<?php
$rootPath = dirname(__DIR__, 2); // Naik dua tingkat dari app/Models ke si-akademik
require_once $rootPath . '/config/database.php';
require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaRepositoryAcara9
{
    private $db;

    public function __construct($databaseInstance)
    {
        $this->db = $databaseInstance;
    }

    public function getAllMahasiswa()
    {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM mahasiswa";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>