<?php
$conn = mysqli_connect(
    "localhost",
    "lf_user",
    "password",
    "projectsi"
);

if(!$conn){
    die("Database Error!");
}