<?php

namespace App\Services;

use App\Models\MahasiswaRepositoryAcara13;
use App\Models\ProdiRepository;

class MahasiswaService
{
    private $repo;
    private $prodiRepo;

    public function __construct(MahasiswaRepositoryAcara13 $repo, ProdiRepository $prodiRepo)
    {
        $this->repo = $repo;
        $this->prodiRepo = $prodiRepo;
    }

    public function create(array $input): array
    {
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $id = $this->repo->create($input);

        return [
            'success' => true,
            'id' => $id
        ];
    }

    public function update($id, array $input): array
    {
        $errors = $this->validate($input, $id);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $updated = $this->repo->update($id, $input);

        return [
            'success' => (bool)$updated
        ];
    }

    private function validate(array $input, $isUpdateId = null): array
    {
        $errors = [];

        if (empty($input['nim'])) {
            $errors['nim'] = 'NIM wajib diisi!';
        } elseif (method_exists($this->repo, 'existsByNim')) {
            if ($this->repo->existsByNim($input['nim'], $isUpdateId)) {
                $errors['nim'] = 'NIM sudah terdaftar!';
            }
        }

        if (empty($input['nama'])) {
            $errors['nama'] = 'Nama mahasiswa wajib diisi!';
        }

        return $errors;
    }
}