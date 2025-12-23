<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }

$user = $_SESSION['user']; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - UMSIDA</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header">
        <div class="logo-container" onclick="openNav()">
            <span style="font-size: 30px; cursor: pointer;">&#9776;</span>
        </div>
        <div class="logo-text">PROFIL SAYA</div>
        <div class="header-icons">
             <a href="profile.php" style="text-decoration: none; color: white;">
                <span style="font-size: 24px;">👤</span>
            </a>
        </div>
    </header>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">Beranda</a>
        <a href="gallery.php">Galeri Temuan</a>
        <a href="dashboard.php">Laporan Kehilangan</a>
        <a href="form_selection.php">Formulir</a>
        <a href="process/auth.php?action=logout" style="color: #ff6b6b;">Logout</a>
    </div>

    <div id="main">
        <div class="form-container">
            <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
                <?php 
                $profile_img = !empty($user['profile_image']) ? 'assets/uploads/profiles/'.$user['profile_image'] : '';
                ?>
                <form action="process/auth.php" method="POST" enctype="multipart/form-data" id="profileForm">
                    <input type="hidden" name="action" value="update_profile">
                    <input type="file" name="profile_image" id="profileImageInput" style="display: none;" onchange="document.getElementById('profileForm').submit()">
                    
                    <div onclick="document.getElementById('profileImageInput').click()" style="width: 100px; height: 100px; background: #ddd; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 40px; overflow: hidden; cursor: pointer; position: relative;">
                        <?php if ($profile_img): ?>
                            <img src="<?= htmlspecialchars($profile_img) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            👤
                        <?php endif; ?>
                        
                        <div style="position: absolute; bottom: 0; width: 100%; background: rgba(0,0,0,0.5); color: white; font-size: 12px; padding: 2px 0;">
                            Edit
                        </div>
                    </div>
                </form>
                
                <h2 style="margin-bottom: 5px;"><?= htmlspecialchars($user['name']) ?></h2>
                <p style="color: #666; margin-bottom: 20px;"><?= htmlspecialchars($user['email']) ?></p>
                
                <div style="text-align: left; border-top: 1px solid #eee; padding-top: 20px;">
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" value="<?= htmlspecialchars($user['role']) ?>" disabled>
                    </div>
                </div>

                <a href="process/auth.php?action=logout">
                    <button class="btn-primary" style="background-color: #ff6b6b; margin-top: 10px;">Logout</button>
                </a>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>