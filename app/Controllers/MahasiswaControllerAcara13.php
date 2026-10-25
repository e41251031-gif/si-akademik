<?php

namespace App\Controllers;

// Wajib menyertakan file model dan service agar tidak error "Class not found"
require_once __DIR__ . '/../Models/MahasiswaRepositoryAcara13.php';
require_once __DIR__ . '/../Models/ProdiRepository.php';
require_once __DIR__ . '/../Services/MahasiswaService.php';

use App\Services\MahasiswaService;
use App\Models\MahasiswaRepositoryAcara13;
use App\Models\ProdiRepository;

class MahasiswaControllerAcara13
{
    private $service;
    private $repo;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->repo = new MahasiswaRepositoryAcara13();
        $prodiRepo = new ProdiRepository();
        $this->service = new MahasiswaService($this->repo, $prodiRepo);
    }

    public function index()
    {
        return $this->repo->getAll();
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function store()
    {
        $result = $this->service->create($_POST);

        if ($result['success']) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data berhasil ditambahkan.'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => implode(' ', $result['errors']) ?: 'Data gagal disimpan.'
            ];
        }
        header('Location: index_acara13.php');
        exit;
    }

    public function update($id)
    {
        $result = $this->service->update($id, $_POST);

        if ($result['success']) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data berhasil diubah.'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => implode(' ', $result['errors']) ?: 'Data gagal diubah.'
            ];
        }
        header('Location: index_acara13.php');
        exit;
    }
}