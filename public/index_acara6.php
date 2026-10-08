<?php

$uri = $_SERVER['REQUEST_URI'] ?? '';
$pathInfo = $_SERVER['PATH_INFO'] ?? '';

// Variable untuk menyimpan pesan error
$errorMessage = '';

// 1. Route Logout
if (strpos($uri, '/logout') !== false || $pathInfo === '/logout') {
    echo "Anda telah logout";

// 2. Route Login
} elseif (strpos($uri, '/login') !== false || $pathInfo === '/login') {
    
    // Cek jika pengguna mengirimkan form (Method POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validasi sesuai instruksi: Username = admin & Password = 12345
        if ($username === 'admin' && $password === '12345') {
            // Jika benar, masuk ke Dashboard
            ?>
            <!DOCTYPE html>
            <html lang="id">
            <head>
                <meta charset="UTF-8">
                <title>Dashboard Admin</title>
            </head>
            <body>
                <h2>Selamat Datang di Dashboard Admin!</h2>
                <p>Anda berhasil login.</p>
                <a href="logout">Logout</a>
            </body>
            </html>
            <?php
            exit;
        } else {
            // Jika salah, tampilkan pesan error
            $errorMessage = "Username atau password salah";
        }
    }

    // Tampilan Form Login
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Login Admin</title>
    </head>
    <body>
        <h2>Login Admin</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (!empty($errorMessage)): ?>
            <p style="color: red; font-weight: bold;"><?= $errorMessage; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <p>
                <label for="username">Username </label>
                <input type="text" name="username" id="username" value="<?= htmlspecialchars($_POST['username'] ?? 'admin') ?>" required>
            </p>
            <p>
                <label for="password">Password </label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <button type="submit">Login</button>
            </p>
        </form>
    </body>
    </html>
    <?php

// 3. Route Tambah Mahasiswa
} elseif (strpos($uri, '/mahasiswa/create') !== false) {
    echo "Halaman Tambah Mahasiswa";

// 4. Route Detail Mahasiswa dengan ID
} elseif (preg_match('/\/mahasiswa\/(\d+)/', $uri, $matches)) {
    echo "Detail Mahasiswa dengan ID: " . $matches[1];

// 5. Route Mahasiswa
} elseif (strpos($uri, '/mahasiswa') !== false) {
    echo "Halaman Mahasiswa";

} else {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";
}