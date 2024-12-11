<?php
session_start();
require '../DB/Dbzahra.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Cek token
    $query = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()