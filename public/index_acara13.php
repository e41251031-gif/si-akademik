<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/Controllers/MahasiswaControllerAcara13.php';
use App\Controllers\MahasiswaControllerAcara13;

$controller = new MahasiswaControllerAcara13();
$action = $_GET['action'] ?? 'index';

// Menangkap proses submit form (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'store') {
        $controller->store();
    } elseif ($action === 'update') {
        $id = $_GET['id'] ?? null;
        $controller->update($id);
    }
}

$mahasiswaList = $controller->index();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum Acara 13 - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Sistem Informasi Akademik - Acara 13</h3>
            <a href="index_acara13.php" class="btn btn-light btn-sm">Beranda</a>
        </div>
        <div class="card-body">
            
            <?php
            if (isset($_SESSION['flash'])) {
                $flash = $_SESSION['flash'];
                $type = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
                echo '<div class="alert ' . $type . ' alert-dismissible fade show" role="alert">' 
                     . htmlspecialchars($flash['message']) . 
                     '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' 
                     . '</div>';
                unset($_SESSION['flash']);
            }
            ?>

            <?php if ($action === 'create'): ?>
                <h4 class="mb-3">Tambah Data Mahasiswa</h4>
                <form action="index_acara13.php?action=store" method="POST">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required placeholder="Masukkan NIM...">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan Nama...">
                    </div>
                    <div class="mb-3">
                        <label for="prodi_id" class="form-label">ID Prodi</label>
                        <input type="number" class="form-control" id="prodi_id" name="prodi_id" placeholder="Masukkan ID Prodi (opsional)...">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                    <a href="index_acara13.php" class="btn btn-secondary">Batal</a>
                </form>

            <?php elseif ($action === 'edit' && isset($_GET['id'])): ?>
                <?php
                $editId = $_GET['id'];
                $currentData = $controller->getById($editId);
                ?>
                <h4 class="mb-3">Ubah Data Mahasiswa</h4>
                <form action="index_acara13.php?action=update&id=<?php echo $editId; ?>" method="POST">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($currentData['nim'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($currentData['nama'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodi_id" class="form-label">ID Prodi</label>
                        <input type="number" class="form-control" id="prodi_id" name="prodi_id" value="<?php echo htmlspecialchars($currentData['prodi_id'] ?? ''); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index_acara13.php" class="btn btn-secondary">Batal</a>
                </form>

            <?php else: ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Daftar Mahasiswa</h4>
                    <a href="index_acara13.php?action=create" class="btn btn-primary">+ Tambah Mahasiswa</a>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>ID Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mahasiswaList)): ?>
                            <?php $no = 1; foreach ($mahasiswaList as $row): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($row['nim']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($row['prodi_id'] ?? '-'); ?></td>
                                    <td>
                                        <a href="index_acara13.php?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data mahasiswa.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>