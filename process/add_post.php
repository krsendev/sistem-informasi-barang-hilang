<?php
session_start();
require '../config/database.php';

$user_id = $_SESSION['user']['id'];

$type = $_POST['type'];
$nama = $_POST['nama_barang'];
$desk = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$waktu = $_POST['waktu'];
$kontak = $_POST['kontak'];

$foto = null;
if (!empty($_FILES['foto']['name'])) {
    $foto = time() . $_FILES['foto']['name'];
    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "../uploads/$foto"
    );
}

mysqli_query($conn,
    "INSERT INTO posts
    (user_id,type,nama_barang,deskripsi,lokasi,waktu,kontak,foto)
    VALUES
    ('$user_id','$type','$nama','$desk','$lokasi','$waktu','$kontak','$foto')"
);

header("Location: ../index.php");
