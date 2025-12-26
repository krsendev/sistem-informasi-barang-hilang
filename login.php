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
    <title>Login - UMSIDA Barang Hilang</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">

    <div class="auth-card">
        <div class="auth-header">
            <div style="font-size: 24px; font-weight: bold; color: var(--primary-blue); margin-bottom: 10px;">UMSIDA</div>
            <div style="width: 80px; height: 80px; background: var(--secondary-blue, #2d4059); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                 <span style="font-size: 40px;">🔒</span>
            </div>
        </div>

        <form action="process/auth.php" method="POST">
            <input type="hidden" name="action" value="login">
            
            <div class="form-group">
                <input type="text" name="email" placeholder="Email / NIM" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div style="text-align: right; margin-bottom: 20px;">
                <a href="forgot_password.php" style="color: #666; font-size: 0.8rem; text-decoration: none;">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">Login</button>
        </form>

        <div style="margin-top: 20px; font-size: 0.8rem;">
            Tidak punya akun? <a href="register.php" style="color: var(--primary-blue); font-weight: bold;">Mendaftar</a>
        </div>
    </div>

</body>
</html>