<?php
session_start();
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit; 
    }
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
        <h2>Buat Laporan</h2>
        <form action="process/add_post.php" method="POST" enctype="multipart/form-data">
            <select name="type">
                <option value="kehilangan">Kehilangan</option>
                <option value="temuan">Temuan</option>
            </select>
            <input name="nama_barang" placeholder="Nama Barang" required>
            <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
            <input name="lokasi" placeholder="Lokasi">
            <input name="waktu" placeholder="Waktu">
            <input name="kontak" placeholder="Kontak (WA)">
            <input type="file" name="foto">
            <button>Kirim</button>
        </form>
    </div>

</body>
</html>
