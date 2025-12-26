<?php
require '../config/db.php';

$sql = file_get_contents('../database/add_nim_column.sql');

if (mysqli_query($conn, $sql)) {
    echo "Database updated successfully: Added NIM column.";
} else {
    echo "Error updating database: " . mysqli_error($conn);
}
?>
