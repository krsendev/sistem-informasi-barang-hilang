<?php
require '../config/database.php';
header('Content-Type: application/json');

$type = $_GET['type'] ?? null;

$sql = "SELECT id,nama_barang,deskripsi,lokasi,waktu,kontak,foto,created_at
        FROM posts";
if ($type === 'temuan' || $type === 'kehilangan') {
    $sql .= " WHERE type='$type'";
}
$sql .= " ORDER BY created_at DESC";

$res = mysqli_query($conn, $sql);
$data = [];
while($r = mysqli_fetch_assoc($res)) $data[] = $r;

echo json_encode($data);