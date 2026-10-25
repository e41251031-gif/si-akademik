<?php
require_once __DIR__ . '/../Models/MahasiswaRepositoryAcara14.php';

class MahasiswaServiceAcara14 {
    private $repo;

    public function __construct() {
        $this->repo = new MahasiswaRepositoryAcara14();
    }

    private function logError($message) {
        $logPath = __DIR__ . '/storage/logs/app.log';
        $logDir = dirname($logPath);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        $logMessage = date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
        error_log($logMessage, 3, $logPath);
    }

    public function store($data) {
        try {
            if (empty(trim($data['nim']))) throw new Exception("NIM wajib diisi!");
            if (empty(trim($data['nama']))) throw new Exception("Nama wajib diisi!");
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) throw new Exception("Format email tidak valid!");
            if ($this->repo->existsByNim($data['nim'])) throw new Exception("NIM sudah terdaftar.");

            return $this->repo->create($data);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            throw $e;
        }
    }

    public function edit($id, $data) {
        try {
            if (empty(trim($data['nim']))) throw new Exception("NIM wajib diisi!");
            if (empty(trim($data['nama']))) throw new Exception("Nama wajib diisi!");
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) throw new Exception("Format email tidak valid!");
            if ($this->repo->existsByNim($data['nim'], $id)) throw new Exception("NIM sudah terdaftar oleh mahasiswa lain.");

            return $this->repo->update($id, $data);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            throw $e;
        }
    }
}