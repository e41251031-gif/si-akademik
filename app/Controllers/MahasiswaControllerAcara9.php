<?php
class MahasiswaControllerAcara9
{
    private MahasiswaRepositoryAcara9 $repository;

    // Dependency Injection lewat constructor
    public function __construct(MahasiswaRepositoryAcara9 $repository)
    {
        $this->repository = $repository;
    }

    private function h(string $s): string
    {
        return htmlspecialchars($s);
    }

    // TAMPIL + form tambah
    public function index(string $pesan = ''): void
    {
        echo "<h2>Data Mahasiswa - Acara 9 (Dependency Injection & Object Composition)</h2>";
        if ($pesan !== '') {
            echo "<p style='color:red'>" . $this->h($pesan) . "</p>";
        }

        echo "<h3>Tambah Mahasiswa</h3>";
        echo "<form method='post' action='?aksi=simpan'>
                NIM: <input name='nim'> Nama: <input name='nama'> Prodi: <input name='prodi'>
                <button type='submit'>Simpan</button>
              </form><br>";

        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>NIM</th><th>Nama</th><th>Prodi</th><th>Aksi</th></tr>";
        foreach ($this->repository->getAllMahasiswa() as $mhs) {
            $nim = $this->h($mhs->getNim());
            echo "<tr>";
            echo "<td>$nim</td>";
            echo "<td>" . $this->h($mhs->getNama()) . "</td>";
            echo "<td>" . $this->h($mhs->getProdi()) . "</td>";
            echo "<td>
                    <a href='?aksi=edit&nim=$nim'>Ubah</a>
                    <form method='post' action='?aksi=hapus' style='display:inline'
                          onsubmit=\"return confirm('Hapus data ini?')\">
                        <input type='hidden' name='nim' value='$nim'>
                        <button type='submit'>Hapus</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // TAMBAH
    public function store(): void
    {
        try {
            $m = new Mahasiswa($_POST['nim'] ?? '', $_POST['nama'] ?? '', $_POST['prodi'] ?? '');
            $this->repository->create($m);
            header('Location: index_acara9.php');
            exit;
        } catch (Exception $e) {
            $this->index($e->getMessage());
        }
    }

    // FORM UBAH
    public function edit(string $nim): void
    {
        $m = $this->repository->findByNim($nim);
        if ($m === null) {
            $this->index("Data tidak ditemukan");
            return;
        }
        echo "<h2>Ubah Mahasiswa</h2>";
        echo "<form method='post' action='?aksi=ubah'>
                NIM: <input name='nim' value='" . $this->h($m->getNim()) . "' readonly><br>
                Nama: <input name='nama' value='" . $this->h($m->getNama()) . "'><br>
                Prodi: <input name='prodi' value='" . $this->h($m->getProdi()) . "'><br>
                <button type='submit'>Update</button> <a href='index_acara9.php'>Batal</a>
              </form>";
    }

    // UBAH
    public function update(): void
    {
        try {
            $m = $this->repository->findByNim($_POST['nim'] ?? '');
            if ($m === null) {
                throw new Exception("Data tidak ditemukan");
            }
            $m->setNama($_POST['nama'] ?? '');    // lewat setter, divalidasi
            $m->setProdi($_POST['prodi'] ?? '');
            $this->repository->update($m);
            header('Location: index_acara9.php');
            exit;
        } catch (Exception $e) {
            $this->index($e->getMessage());
        }
    }

    // HAPUS
    public function destroy(): void
    {
        $this->repository->delete($_POST['nim'] ?? '');
        header('Location: index_acara9.php');
        exit;
    }
}