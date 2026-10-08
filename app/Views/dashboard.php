<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

    <h1>Dashboard</h1>

    <h3>
        Selamat datang, <?= $_SESSION['user_name'] ?? 'Admin'; ?>
    </h3>

    <a href="/si-akademik/public/logout">Logout</a>

</body>
</html>