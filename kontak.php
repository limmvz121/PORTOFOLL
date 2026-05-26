<?php
require_once 'koneksi.php';

$profil = $pdo->query("SELECT * FROM profil LIMIT 1")->fetch(PDO::FETCH_ASSOC);

// Variabel untuk pesan sukses atau error
$sukses = "";
$error  = "";

// Proses form hanya jika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil dan bersihkan data dari form
    $nama  = trim($_POST['nama']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $isi   = trim($_POST['isi']   ?? '');

    // Validasi: pastikan semua field terisi dan email valid
    if (empty($nama) || empty($email) || empty($isi)) {
        $error = "Semua field wajib diisi!";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";

    } else {
        // Simpan ke database menggunakan Prepared Statement
        $stmt = $pdo->prepare("INSERT INTO pesan (nama, email, isi) VALUES (:nama, :email, :isi)");
        $stmt->execute([
            ':nama'  => $nama,
            ':email' => $email,
            ':isi'   => $isi
        ]);
        $sukses = "Pesan berhasil dikirim! Terima kasih, {$nama}.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav>
    <div class="logo"><?= htmlspecialchars($profil['nama']) ?></div>
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="proyek.php">Proyek</a></li>
      <li><a href="kontak.php">Kontak</a></li>
    </ul>
  </nav>

  <div class="form-kontak">
    <h1>Hubungi Saya</h1>
    <p class="sub">Punya pertanyaan atau ingin berkolaborasi? Kirim pesan yuk!</p>

    <!-- Tampilkan pesan sukses atau error -->
    <?php if ($sukses): ?>
      <div class="alert sukses">✓ <?= $sukses ?></div>
    <?php elseif ($error): ?>
      <div class="alert error">✗ <?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="kontak.php">

      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama kamu" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="email@kamu.com" required>
      </div>

      <div class="form-group">
        <label for="isi">Pesan</label>
        <textarea id="isi" name="isi" placeholder="Tulis pesanmu di sini..." required></textarea>
      </div>

      <button type="submit">Kirim Pesan</button>

    </form>
  </div>

  <footer>
    <p>© 2025 <?= htmlspecialchars($profil['nama']) ?></p>
  </footer>

</body>
</html>
          