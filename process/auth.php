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
        echo "<script>alert('User tidak ditemukan!'); window.location='../login.php';</script>";
    }

} elseif ($action === 'logout') {
    session_destroy();
    header("Location: ../login.php");

} else {
    // If accessed directly without action
    header("Location: ../login.php");
}
?>
