<?php
$keyword = "";
$pesan_login = "";

if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $pesan_login = "Username yang dimasukkan: " . $username;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SI Akademik</title>
</head>
<body>

    <h1>Selamat datang di SI Akademik</h1>

    <h3>Pencarian</h3>

    <form method="GET" action="">
        <label>Keyword:</label>
        <input type="text" name="keyword">
        <button type="submit">Cari</button>
    </form>

    <?php
    if ($keyword != "") {
        echo "<p>Keyword yang dicari: <b>" . $keyword . "</b></p>";
    }
    ?>

    <hr>

    <h3>Login</h3>

    <form method="POST" action="">
        <p>
            <label>Username:</label>
            <input type="text" name="username">
        </p>

        <p>
            <label>Password:</label>
            <input type="password" name="password">
        </p>

        <button type="submit">Login</button>
    </form>

    <?php
    if ($pesan_login != "") {
        echo "<p><b>$pesan_login</b></p>";
    }
    ?>

</body>
</html>