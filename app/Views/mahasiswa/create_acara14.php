<?php
session_start();
require_once __DIR__ . '/../../../app/Models/MahasiswaRepositoryAcara14.php';
require_once __DIR__ . '/../../../app/Services/MahasiswaServiceAcara14.php';

$service = new MahasiswaServiceAcara14();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $service->store($_POST);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data mahasiswa berhasil ditambahkan.'];
        header("Location: ../../../public/index_acara14.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa - Acara 14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Tambah Mahasiswa Baru</h2>
    <hr>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($_POST['nim'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($_POST['nama'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control" value="<?= htmlspecialchars($_POST['angkatan'] ?? ''); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="../../../public/index_acara14.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>