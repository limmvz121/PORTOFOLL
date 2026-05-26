<?php

$host = "localhost";      // server database
$db   = "db_portofolio"; // nama database yang tadi dibuat
$user = "root";          // username default XAMPP
$pass = "";              // password default XAMPP (kosong)

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$db};charset=utf8",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Tambahkan ini sementara untuk test:
          
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
          