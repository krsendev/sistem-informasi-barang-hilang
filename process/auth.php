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

} elseif ($action === 'update_profile') {
    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    $userId = $_SESSION['user']['id'];
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_image']['name'];
        $filetype = $_FILES['profile_image']['type'];
        $filesize = $_FILES['profile_image']['size'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
             echo "<script>alert('Format file tidak valid!'); window.location='../profile.php';</script>";
             exit;
        }

        if ($filesize > 5 * 1024 * 1024) { // 5MB limit
            echo "<script>alert('Ukuran file terlalu besar!'); window.location='../profile.php';</script>";
            exit;
        }

        // Generate unique filename
        $newFilename = "profile_" . $userId . "_" . time() . "." . $ext;
        $destination = "../assets/uploads/profiles/" . $newFilename;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $destination)) {
            // Update database
            $query = "UPDATE users SET profile_image = '$newFilename' WHERE id = '$userId'";
            if (mysqli_query($conn, $query)) {
                // Update session
                $_SESSION['user']['profile_image'] = $newFilename;
                 echo "<script>alert('Foto profil berhasil diperbarui!'); window.location='../profile.php';</script>";
            } else {
                 echo "<script>alert('Gagal update database!'); window.location='../profile.php';</script>";
            }
        } else {
             echo "<script>alert('Gagal upload file!'); window.location='../profile.php';</script>";
        }
    } else {
        header("Location: ../profile.php");
    }

} elseif ($action === 'logout') {
    session_destroy();
    header("Location: ../login.php");

} else {
    // If accessed directly without action
    header("Location: ../login.php");
}
?>
