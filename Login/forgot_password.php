<?php
session_start();
require '../DB/Dbzahra.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_phone = $_POST['email_or_phone'];

    // Cek apakah email/nomor HP terdaftar
    $query = "SELECT * FROM users WHERE email_or_phone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email_or_phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50)); // Buat token acak
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token berlaku 1 jam

        // Simpan token dan waktu kedaluwarsa di database
        $query = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $user['id'], $token, $expiry);
        $stmt->execute();

        // Kirim email dengan tautan reset password
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;
        $subject = "Reset Password";
        $message = "Klik tautan berikut untuk mereset password Anda: " . $reset_link;
        mail($email_or_phone, $subject, $message); // Pastikan server Anda dapat mengirim email

        echo "<div class='alert alert-success'>Tautan reset password telah dikirim ke email Anda.</div>";
    } else {
        echo "<div class='alert alert-danger'>Email/nomor HP tidak terdaftar!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Lupa Password</h1>
            <form method="POST" action="">
                <div class="mb-3">
                    <input type="text" name="email_or_phone" class="form-control" placeholder="Nomor HP atau email" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Kirim Tautan Reset</button>
            </form>
            <p class="mt-3 text-center"><a href="login.php">Kembali ke Login</a></p>
        </div>
    </div>
</body>
</html>