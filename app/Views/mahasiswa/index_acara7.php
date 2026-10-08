<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa - Acara 7</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Daftar Mahasiswa (Acara 7 - Database MySQL)</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mahasiswa)): ?>
                    <?php $no = 1; foreach ($mahasiswa as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nim'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($row['nama'] ?? '-'); ?></td>
                            <!-- Mengecek kolom prodi / program_studi / jurusan -->
                            <td>
                                <?= htmlspecialchars(
                                    $row['prodi'] ?? 
                                    $row['program_studi'] ?? 
                                    $row['jurusan'] ?? 
                                    $row['prodi_id'] ?? '-'
                                ); ?>
                            </td>
                            <!-- Mengecek kolom status -->
                            <td>
                                <?= htmlspecialchars(
                                    $row['status'] ?? 
                                    $row['status_mahasiswa'] ?? 
                                    $row['is_active'] ?? 'Aktif'
                                ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Data Mahasiswa Kosong / Belum Ada Database</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>