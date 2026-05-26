<?php
// 1. Panggil file koneksi database
require_once 'koneksi.php';

// 2. Ambil data profil dari tabel profil
$stmt   = $pdo->query("SELECT * FROM profil LIMIT 1");
$profil = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Ambil 3 proyek terbaru untuk ditampilkan di halaman depan
$stmt2  = $pdo->query("SELECT * FROM proyek ORDER BY dibuat_pada DESC LIMIT 3");
$proyek = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portofolio - <?= htmlspecialchars($profil['nama']) ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- NAVIGASI -->
  <nav>
    <div class="logo"><?= htmlspecialchars($profil['nama']) ?></div>
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="proyek.php">Proyek</a></li>
      <li><a href="kontak.php">Kontak</a></li>
    </ul>
  </nav>

  <!-- HERO SECTION -->
  <section class="hero">
    <p class="salam">👋 Halo, saya</p>
    <h1><?= htmlspecialchars($profil['nama']) ?></h1>
    <p class="jabatan"><?= htmlspecialchars($profil['jabatan']) ?></p>
    <p class="bio"><?= htmlspecialchars($profil['bio']) ?></p>
    <a href="proyek.php" class="btn">Lihat Proyek Saya →</a>
  </section>

  <!-- PREVIEW PROYEK -->
  <section class="preview-proyek">
    <h2>Proyek Terbaru</h2>
    <div class="grid-proyek">

      <?php foreach ($proyek as $p): ?>
      <div class="kartu">
        <h3><?= htmlspecialchars($p['judul']) ?></h3>
        <p><?= htmlspecialchars($p['deskripsi']) ?></p>
        <span class="teknologi"><?= htmlspecialchars($p['teknologi']) ?></span>
      </div>
      <?php endforeach; ?>

    </div>
    <a href="proyek.php" class="btn-outline">Semua Proyek</a>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>© 2025 <?= htmlspecialchars($profil['nama']) ?> — Dibuat dengan PHP & MySQL</p>
  </footer>

</body>
</html>
          