<h2>Data Mahasiswa - Acara 10 (Inheritance & Repository Pattern)</h2>

<?php if ($pesan !== ''): ?>
    <p style="color:red"><?= htmlspecialchars($pesan) ?></p>
<?php endif; ?>

<h3>Tambah Mahasiswa</h3>
<form method="post" action="?aksi=simpan">
    NIM: <input name="nim">
    Nama: <input name="nama">
    Prodi: <input name="prodi">
    <button type="submit">Simpan</button>
</form>
<br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr><th>NIM</th><th>Nama</th><th>Prodi</th><th>Aksi</th></tr>
    <?php foreach ($mahasiswa as $m): ?>
    <tr>
        <td><?= htmlspecialchars($m->getNim()) ?></td>
        <td><?= htmlspecialchars($m->getNama()) ?></td>
        <td><?= htmlspecialchars($m->getProdi()) ?></td>
        <td>
            <a href="?aksi=edit&nim=<?= urlencode($m->getNim()) ?>">Ubah</a>
            <form method="post" action="?aksi=hapus" style="display:inline"
                  onsubmit="return confirm('Hapus data ini?')">
                <input type="hidden" name="nim" value="<?= htmlspecialchars($m->getNim()) ?>">
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>