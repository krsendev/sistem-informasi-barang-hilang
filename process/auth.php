<?php
session_start();
require '../config/db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'register') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if ($password !== $confirm_password) {
        echo "<script>alert('Password tidak cocok!'); window.location='../register.php';</script>";
        exit;
    }

    // Check email
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='../register.php';</script>";
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $query = "INSERT INTO users (username, email, password) VALUES ('$nama', '$email', '$hashed_password')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='../login.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location='../register.php';</script>";
    }

} elseif ($action === 'login') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' OR username = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'profile_image' => $user['profile_image'] ?? null // Add profile image to session
            ];
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Password salah!'); window.location='../login.php';</script>";
        }
    } else {
    } else {
        echo "<script>alert('User tidak ditemukan!'); window.location='../login.php';</script>";
    }

} elseif ($action === 'forgot_password') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if user exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        // Generate 6 digit code
        $token = rand(100000, 999999);
        $expires = date("Y-m-d H:i:s", strtotime("+15 minutes"));
        
        // Save to password_resets
        // First delete any previous tokens for this email
        mysqli_query($conn, "DELETE FROM password_resets WHERE email = '$email'");
        
        $query = "INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', '$expires')";
        
        if (mysqli_query($conn, $query)) {
            // MOCK EMAIL SENDING
            // In a real scenario, use PHPMailer here.
            
            // For now, we alert the code (for testing)
            echo "<script>
                alert('Kode verifikasi Anda adalah: $token'); 
                window.location='../verify_code.php?email=$email';
            </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan database.'); window.location='../forgot_password.php';</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar!'); window.location='../forgot_password.php';</script>";
    }

} elseif ($action === 'verify_code') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = mysqli_real_escape_string($conn, $_POST['otp']); // Changed name to otp to match form likely
    
    $query = "SELECT * FROM password_resets WHERE email = '$email' AND token = '$token' AND expires_at > NOW()";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_verified'] = true;
        
        // Delete token
        mysqli_query($conn, "DELETE FROM password_resets WHERE email = '$email'");
        
        header("Location: ../reset_password.php");
    } else {
        echo "<script>alert('Kode salah atau kadaluarsa!'); window.location='../verify_code.php?email=$email';</script>";
    }

} elseif ($action === 'reset_password') {
    if (!isset($_SESSION['reset_verified']) || !$_SESSION['reset_verified']) {
        header("Location: ../login.php");
        exit;
    }
    
    $email = $_SESSION['reset_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        echo "<script>alert('Password tidak cocok!'); window.location='../reset_password.php';</script>";
        exit;
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
    if (mysqli_query($conn, $query)) {
        unset($_SESSION['reset_email']);
        unset($_SESSION['reset_verified']);
        echo "<script>alert('Password berhasil diubah, silakan login.'); window.location='../login.php';</script>";
    } else {
         echo "<script>alert('Gagal mengubah password.'); window.location='../reset_password.php';</script>";
    }

} elseif ($action === 'logout') {
    session_destroy();
    header("Location: ../login.php");

} else {
    // If accessed directly without action
    header("Location: ../login.php");
}
?>
