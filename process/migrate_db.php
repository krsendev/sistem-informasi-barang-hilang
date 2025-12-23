<?php
require '../config/db.php';

$table = 'users';
$column = 'profile_image';

$check = mysqli_query($conn, "SHOW COLUMNS FROM $table LIKE '$column'");

if (mysqli_num_rows($check) == 0) {
    $alter = "ALTER TABLE $table ADD COLUMN $column VARCHAR(255) DEFAULT NULL";
    if (mysqli_query($conn, $alter)) {
        echo "Column '$column' added successfully to table '$table'.";
    } else {
        echo "Error adding column: " . mysqli_error($conn);
    }
} else {
    echo "Column '$column' already exists.";
}
?>
