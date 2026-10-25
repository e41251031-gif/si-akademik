<?php
session_start();
require_once __DIR__ . '/../app/Models/MahasiswaRepositoryAcara14.php';

$repo = new MahasiswaRepositoryAcara14();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    try {
        $repo->delete($_GET['id']);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data mahasiswa berhasil dihapus.'];
    } catch (Exception $e) {
        $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal menghapus data.'];
    }
    header("Location: index_acara14.php");
    exit();
}

$mahasiswaList = $repo->all();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa - Acara 14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Data Mahasiswa (Acara 14)</h2>
    <hr>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['flash']['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Mengarah ke folder Views/mahasiswa -->
    <a href="../app/Views/mahasiswa/create_acara14.php" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Angkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mahasiswaList as $m): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($m['nim']); ?></td>
                <td><?= htmlspecialchars($m['nama']); ?></td>
                <td><?= htmlspecialchars($m['email'] ?? ''); ?></td>
                <td><?= htmlspecialchars($m['angkatan']); ?></td>
                <td>
                    <!-- Mengarah ke folder Views/mahasiswa -->
                    <a href="../app/Views/mahasiswa/edit_acara14.php?id=<?= $m['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index_acara14.php?action=delete&id=<?= $m['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($mahasiswaList)): ?>
            <tr><td colspan="6" class="text-center">Belum ada data mahasiswa.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>