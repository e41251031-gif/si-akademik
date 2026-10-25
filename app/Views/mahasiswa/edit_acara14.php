<?php
session_start();
require_once __DIR__ . '/../../../app/Models/MahasiswaRepositoryAcara14.php';
require_once __DIR__ . '/../../../app/Services/MahasiswaServiceAcara14.php';

$repo = new MahasiswaRepositoryAcara14();
$service = new MahasiswaServiceAcara14();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../../../public/index_acara14.php");
    exit();
}

$mahasiswa = $repo->find($id);
if (!$mahasiswa) {
    header("Location: ../../../public/index_acara14.php");
    exit();
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Sesuaikan dengan nama fungsi di service kamu (edit atau update)
        $service->edit($id, $_POST);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data mahasiswa berhasil diperbarui.'];
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
    <title>Edit Mahasiswa - Acara 14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Edit Data Mahasiswa</h2>
    <hr>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($mahasiswa['nim']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mahasiswa['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($mahasiswa['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control" value="<?= htmlspecialchars($mahasiswa['angkatan']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="../../../public/index_acara14.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>