<h2>Ubah Mahasiswa</h2>
<form method="post" action="?aksi=ubah">
    NIM: <input name="nim" value="<?= htmlspecialchars($m->getNim()) ?>" readonly><br>
    Nama: <input name="nama" value="<?= htmlspecialchars($m->getNama()) ?>"><br>
    Prodi: <input name="prodi" value="<?= htmlspecialchars($m->getProdi()) ?>"><br>
    <button type="submit">Update</button>
    <a href="index_acara10.php">Batal</a>
</form>