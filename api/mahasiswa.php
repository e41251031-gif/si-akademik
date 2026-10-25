<?php
// Atur header agar response dikenali sebagai JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Handle preflight request OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Panggil koneksi database (sesuaikan path jika file config ada di folder config/)
require_once __DIR__ . '/../config/database_acara14.php';

try {
    $db = Database_Acara14::getInstance();
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            // Cek apakah ada parameter ?id=... (GET by ID)
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($data) {
                    echo json_encode([
                        "success" => true,
                        "message" => "Detail data mahasiswa berhasil ditemukan.",
                        "data" => $data
                    ]);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        "success" => false,
                        "message" => "Data mahasiswa dengan ID tersebut tidak ditemukan."
                    ]);
                }
            } else {
                // GET Semua Data Mahasiswa
                $stmt = $db->prepare("SELECT * FROM mahasiswa ORDER BY id DESC");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode([
                    "success" => true,
                    "message" => "Data mahasiswa berhasil diambil.",
                    "total" => count($data),
                    "data" => $data
                ]);
            }
            break;

        case 'POST':
            // Tangkap data JSON yang dikirimkan dari client/Postman
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, true);

            // Jika format bukan JSON murni, coba ambil dari $_POST biasa
            if (empty($input)) {
                $input = $_POST;
            }

            $nim = $input['nim'] ?? '';
            $nama = $input['nama'] ?? '';
            $email = $input['email'] ?? '';
            $angkatan = $input['angkatan'] ?? date('Y');

            // Validasi sederhana
            if (empty($nim) || empty($nama) || empty($email)) {
                http_response_code(400);
                echo json_encode([
                    "success" => false,
                    "message" => "Validasi gagal: NIM, Nama, dan Email wajib diisi."
                ]);
                exit();
            }

            // Simpan ke database menggunakan Prepared Statement
            $stmt = $db->prepare("INSERT INTO mahasiswa (nim, nama, email, angkatan) VALUES (:nim, :nama, :email, :angkatan)");
            $success = $stmt->execute([
                'nim' => $nim,
                'nama' => $nama,
                'email' => $email,
                'angkatan' => $angkatan
            ]);

            if ($success) {
                http_response_code(201);
                echo json_encode([
                    "success" => true,
                    "message" => "Data mahasiswa berhasil ditambahkan.",
                    "data" => [
                        "id" => $db->lastInsertId(),
                        "nim" => $nim,
                        "nama" => $nama,
                        "email" => $email,
                        "angkatan" => $angkatan
                    ]
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    "success" => false,
                    "message" => "Gagal menyimpan data ke database."
                ]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "success" => false,
                "message" => "Metode HTTP tidak didukung."
            ]);
            break;
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Terjadi kesalahan pada server.",
        "error" => $e->getMessage()
    ]);
}