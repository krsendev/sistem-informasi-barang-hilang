<?php
session_start();
$email = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode - UMSIDA Barang Hilang</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">

    <div class="auth-card">
        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Verifikasi Kode</h2>
        
        <p style="margin-bottom: 20px;">
            Masukkan 6 digit kode yang telah dikirim ke <strong><?php echo htmlspecialchars($email); ?></strong>
        </p>

        <form action="process/auth.php" method="POST">
            <input type="hidden" name="action" value="verify_code">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            
            <div class="form-group">
                <input type="text" name="otp" placeholder="000000" maxlength="6" required style="text-align: center; letter-spacing: 5px; font-size: 20px;">
            </div>

            <button type="submit" class="btn-primary">Verifikasi</button>
        </form>
    </div>

</body>
</html>
