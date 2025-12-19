<?php
session_start();
require 'config/database.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }

$uid = $_SESSION['user']['id'];
$my = mysqli_query($conn, "SELECT * FROM posts WHERE user_id=$uid ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <div>Temuan & Kehilangan</div>
        <div>
            <a href="index.php">Beranda</a>
            <a href="report.php">Buat Laporan</a>
            <a href="profile.php">Profil</a>
            <a href="process/logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Postingan Saya</h2>
        <?php while($p = mysqli_fetch_assoc($data)): ?>
        <div class="card">
            <b><?= htmlspecialchars($p['nama_barang']) ?></b>
            <span class="badge <?= $p['type'] ?>"><?= $p['type'] ?></span>
            <br>
            <a href="process/delete_post.php?id=<?= $p['id'] ?>"
            onclick="return confirm('Hapus postingan?')">Hapus</a>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>