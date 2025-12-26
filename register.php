<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - UMSIDA</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">

    <div class="auth-card">
        <div class="auth-header">
            <div style="font-size: 24px; font-weight: bold; color: var(--primary-blue); margin-bottom: 20px;">UMSIDA</div>
            <h3>Daftar akun</h3>
        </div>

        <form action="process/auth.php" method="POST">
            <input type="hidden" name="action" value="register">
            
            <div class="form-group">
                <input type="text" name="nama" placeholder="Nama" required>
            </div>

            <div class="form-group">
                <input type="text" name="nim" placeholder="NIM" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">Daftar</button>
        </form>

        <div style="margin-top: 20px; font-size: 0.8rem;">
            Sudah punya akun? <a href="login.php" style="color: var(--primary-blue); font-weight: bold;">Login</a>
        </div>
    </div>

</body>
</html>
