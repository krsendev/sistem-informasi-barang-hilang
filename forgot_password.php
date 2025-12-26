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
    <title>Lupa Password - UMSIDA Barang Hilang</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">

    <div class="auth-card">
        <div class="auth-header">
            <!-- Logo placeholder or text to match the design -->
             <div style="margin-bottom: 20px;">
                <img src="assets/images/umsida-logo.png" alt="UMSIDA Logo" style="max-width: 200px; display: block; margin: 0 auto;">
                <!-- Fallback if no logo image -->
                <!-- <div style="font-size: 32px; font-weight: bold; color: var(--primary-blue); font-family: serif;">UMSIDA</div>
                <div style="font-size: 10px; letter-spacing: 2px;">DARI SINI PENCERAHAN BERSEMI</div> -->
             </div>
        </div>

        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 10px; color: #000;">Lupa Kata Sandi</h2>
        
        <p style="font-size: 14px; margin-bottom: 20px; color: #333;">
            Kami akan mengirimkan 6 digit kode ke email di bawah ini
        </p>

        <form action="process/auth.php" method="POST">
            <input type="hidden" name="action" value="forgot_password">
            
            <div class="form-group" style="margin-bottom: 15px;">
                <input type="email" name="email" placeholder="Masukkan email yang terdaftar" required 
                       style="background-color: #dcdcdc; color: #555; text-align: center; border-radius: 25px;">
            </div>

            <p style="font-size: 12px; margin-bottom: 20px; color: #333;">
                jika anda lupa email atau nomor telepon yang terdaftar, silahkan mengirimkan email ke <a href="mailto:jokowidodo@solo.id" style="color: var(--primary-blue); text-decoration: none;">jokowidodo@solo.id</a>
            </p>

            <button type="submit" class="btn-primary" style="width: 150px; border-radius: 25px; padding: 10px 0; font-size: 18px;">Kirim</button>
        </form>
    </div>

</body>
</html>
