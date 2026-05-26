<?php
require_once 'koneksi.php';

// Ambil data profil (untuk nama di navigasi)
$profil = $pdo->query("SELECT * FROM profil LIMIT 1")->fetch(PDO::FETCH_ASSOC);

// Ambil SEMUA proyek, diurutkan dari yang terbaru
$semua_proyek = $pdo->query("SELECT * FROM proyek ORDER BY dibuat_pada DESC")
                     ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyek Saya</title>
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

  <div class="preview-proyek">
    <h1>Semua Proyek</h1>
    <p style="color:#64748b; margin-bottom:2rem;">
      Total: <?= count($semua_proyek) ?> proyek
    </p>

    <div class="grid-proyek">
      <?php foreach ($semua_proyek as $p): ?>
      <div class="kartu">
        <h3><?= htmlspecialchars($p['judul']) ?></h3>
        <p><?= htmlspecialchars($p['deskripsi']) ?></p>
        <span class="teknologi"><?= htmlspecialchars($p['teknologi']) ?></span>
      </div>
      <?php endforeach; ?>
    </div>

  </div>

  <footer>
    <p>© 2025 <?= htmlspecialchars($profil['nama']) ?></p>
  </footer>

</body>
</html>
          