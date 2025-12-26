<?php
require '../config/db.php';

$sql = file_get_contents('../database/update_schema.sql');

if (mysqli_multi_query($conn, $sql)) {
    echo "Database updated successfully.";
} else {
    echo "Error updating database: " . mysqli_error($conn);
}
?>
