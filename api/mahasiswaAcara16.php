<?php
// Atur header agar response dikenali sebagai JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../config/database_acara14.php';

try {
    $db = Database_Acara14::getInstance();
    $method = $_SERVER['REQUEST_METHOD'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Fungsi helper untuk mengambil input JSON atau form-data
    function getRequestData() {
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, true);
        if (empty($data)) {
            $data = $_POST;
        }
        return $data;
    }

    switch ($method) {
        case 'GET':
            if ($id) {
                $stmt = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($data) {
                    echo json_encode(["success" => true, "message" => "Detail data ditemukan.", "data" => $data]);
                } else {
                    http_response_code(404);
                    echo json_encode(["success" => false, "message" => "ID tidak ditemukan."]);
                }
            } else {
                $stmt = $db->prepare("SELECT * FROM mahasiswa ORDER BY id DESC");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode(["success" => true, "message" => "Data berhasil diambil.", "total" => count($data), "data" => $data]);
            }
            break;

        case 'POST':
            $input = getRequestData();

            $nim = trim($input['nim'] ?? '');
            $nama = trim($input['nama'] ?? '');
            $email = trim($input['email'] ?? '');
            $angkatan = trim($input['angkatan'] ?? date('Y'));

            if (empty($nim) || empty($nama) || empty($email)) {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "NIM, Nama, dan Email wajib diisi."]);
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "Format email tidak valid."]);
                exit();
            }

            $stmt = $db->prepare("INSERT INTO mahasiswa (nim, nama, email, angkatan) VALUES (:nim, :nama, :email, :angkatan)");
            $success = $stmt->execute(['nim' => $nim, 'nama' => $nama, 'email' => $email, 'angkatan' => $angkatan]);

            if ($success) {
                http_response_code(201);
                echo json_encode([
                    "success" => true,
                    "message" => "Data mahasiswa berhasil ditambahkan.",
                    "data" => ["id" => $db->lastInsertId(), "nim" => $nim, "nama" => $nama, "email" => $email, "angkatan" => $angkatan]
                ]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Gagal menyimpan data."]);
            }
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "ID mahasiswa tidak disertakan."]);
                exit();
            }

            $checkStmt = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
            $checkStmt->execute(['id' => $id]);
            $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$existing) {
                http_response_code(404);
                echo json_encode(["success" => false, "message" => "ID tidak ditemukan."]);
                exit();
            }

            $input = getRequestData();
            $nim = trim($input['nim'] ?? $existing['nim']);
            $nama = trim($input['nama'] ?? $existing['nama']);
            $email = trim($input['email'] ?? $existing['email']);
            $angkatan = trim($input['angkatan'] ?? $existing['angkatan']);

            $updateStmt = $db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, angkatan = :angkatan WHERE id = :id");
            $updateSuccess = $updateStmt->execute(['nim' => $nim, 'nama' => $nama, 'email' => $email, 'angkatan' => $angkatan, 'id' => $id]);

            if ($updateSuccess) {
                echo json_encode([
                    "success" => true,
                    "message" => "Data mahasiswa berhasil diperbarui.",
                    "data" => ["id" => $id, "nim" => $nim, "nama" => $nama, "email" => $email, "angkatan" => $angkatan]
                ]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Gagal memperbarui data."]);
            }
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "ID mahasiswa tidak disertakan."]);
                exit();
            }

            $checkStmt = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
            $checkStmt->execute(['id' => $id]);
            $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$existing) {
                http_response_code(404);
                echo json_encode(["success" => false, "message" => "ID tidak ditemukan."]);
                exit();
            }

            $delStmt = $db->prepare("DELETE FROM mahasiswa WHERE id = :id");
            $delSuccess = $delStmt->execute(['id' => $id]);

            if ($delSuccess) {
                echo json_encode(["success" => true, "message" => "Data mahasiswa berhasil dihapus."]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Gagal menghapus data."]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["success" => false, "message" => "Metode HTTP tidak didukung."]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Server error.", "error" => $e->getMessage()]);
}