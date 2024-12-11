<?php
session_start();
require '../DB/Dbzahra.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email_or_phone = $_POST['email_or_phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi password
        if ($password !== $confirm_password) {
            $error = "Password dan konfirmasi password tidak cocok!";
        } else {
            // Periksa apakah email/nomor HP sudah ada di database
            $stmt = $conn->prepare("SELECT * FROM users WHERE email_or_phone = ?");
            $stmt->bind_param("s", $email_or_phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error = "Email atau nomor HP sudah terdaftar!";
            } else {
                // Enkripsi password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Simpan data ke database
                $stmt = $conn->prepare("INSERT INTO users (email_or_phone, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $email_or_phone, $hashed_password);
                $stmt->execute();

                $success = "Akun berhasil dibuat! Silakan login.";
            }
        }
    }
} catch (Exception $e) {
    $error = "Terjadi kesalahan: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Daftar Akun</h1>
            
            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <input type="text" name="email_or_phone" class="form-control" placeholder="Nomor HP atau email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>

            </form>
            <p class="mt-3 text-center">Sudah memiliki akun? <a href="loginnew.php">Login, Sekarang!</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
