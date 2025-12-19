<?php
session_start();
require '../config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email' LIMIT 1"
);

$user = mysqli_fetch_assoc($query);

if(user && password_verify($password, $user['password'])){
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
    ];
    header("Location: ../dashboard.php");
}else{
    header("Location: ../login.php?error=1");
}