<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Mahasiswa</h2>
            <a href="/si-akademik/public/mahasiswa/create" class="btn btn-primary">+ Tambah Mahasiswa</a>
        </div>

        <form action="/si-akademik/public/mahasiswa" method="GET" class="row g-2 mb-4">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama / NIM..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="/si-akademik/public/mahasiswa" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Prodi</th>
                                <th>Angkatan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($mahasiswa)): ?>
                                <?php foreach ($mahasiswa as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nim']) ?></td>
                                        <td><?= htmlspecialchars($row['nama']) ?></td>
                                        <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($row['nama_prodi'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($row['angkatan']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $row['status'] === 'aktif' ? 'success' : 'danger' ?>">
                                                <?= htmlspecialchars($row['status']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <form action="/si-akademik/public/mahasiswa/destroy" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="d-inline">
                                                <input type="hidden" name="nim" value="<?= htmlspecialchars($row['nim']) ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">Data mahasiswa tidak ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>