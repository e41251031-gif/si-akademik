<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $pesan = "Request menggunakan GET";
} else if ($method == "POST") {
    $pesan = "Request menggunakan POST";
} else {
    $pesan = "Request tidak dikenali";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deteksi Method Request</title>
</head>
<body>

    <h2>Deteksi Method Request</h2>

    <p><?php echo $pesan; ?></p>

</body>
</html>