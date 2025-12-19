<?php
session_start();
require '../config/database.php';
if (!isset($_SESSION['user'])) { header("Location: ../login.php"); exit; }

$id = (int)$_GET['id'];
$uid = $_SESSION['user']['id'];

mysqli_query($conn, "DELETE FROM posts WHERE id=$id AND user_id=$uid");

header("Location: ../profile.php");
