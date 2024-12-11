<?php
session_start();

// Periksa apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['role'] === 'user';

?>

<?php
// Koneksi ke database
require '../DB/Dbzahra.php';

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['name'];  
    $tempat_tinggal = $_POST['address'];  
    $datetime = $_POST['datetime'];  
    $metode_pembayaran = $_POST['payment'];  
    $bukti_transfer = NULL;  

    // Menangani file upload (bukti transfer)
    if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
        // Membaca file gambar sebagai binary
        $bukti_transfer = file_get_contents($_FILES['bukti']['tmp_name']);
    }

    // Cek apakah bukti transfer kosong
    if (!$bukti_transfer) {
        echo "Bukti transfer harus diunggah.";
        exit;
    }

    // Menyimpan data ke database
    $sql = "INSERT INTO bookings (nama, tempat_tinggal, datetime, metode_pembayaran, bukti_transfer)
            VALUES (?, ?, ?, ?, ?)";

    // Menyiapkan statement untuk query SQL dengan parameter (prepared statement)
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('sssss', $nama, $tempat_tinggal, $datetime, $metode_pembayaran, $bukti_transfer);

        if ($stmt->execute()) {
            // Jika berhasil, arahkan ke halaman utama (Final.php)
            header('Location: ../Final.php');
            exit;  // Pastikan script berhenti setelah pengalihan
        } else {
            echo "Error: " . $stmt->error;  // Debugging error SQL
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Gagal menyiapkan statement SQL: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Booking - Zahrarental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand fs-4" href="../Final.php">Zahrarental</a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Sidebar -->
            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header" style="border-bottom: 1px solid black;">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Zahrarental</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- Sidebar Body -->
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-items-center fs-6 flex-grow-1 pe-3">
                        <li class="nav-item mx-2"><a class="nav-link active" aria-current="page" href="../Final.php">Home</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="../AboutRental/About.php">About rental</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="../Contact/contact.php">Contact</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="../Pesanan/pesanan.php">Pemesanan</a></li>
                    </ul>
                    <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                            <span class="text-black">Halo, <?= htmlspecialchars($_SESSION['name'] ?? 'Pengguna'); ?></span>
                            <a href="profil.php" class="text-black">Profil</a>
                            <a href="../Login/logout.php" class="text-danger">Logout</a>
                        <?php else: ?>
                            <a href="Login/loginnew.php" class="text-black">Login</a>
                            <a href="Login/register.php" class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4">Sign up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulir Pendaftaran Booking -->
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Pendaftaran Booking</h2>
        <form action="" method="POST" enctype="multipart/form-data">    
            <!-- Tanggal & Waktu -->
            <div class="mb-3">
                <label for="datetime" class="form-label">Tanggal & Waktu</label>
                <input type="datetime-local" class="form-control" id="datetime" name="datetime" min="<?php echo date('Y-m-d\TH:i', strtotime('+1 day')); ?>" required>
            </div>
            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="payment" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="payment" name="payment" required>
                    <option value="" selected>Pilih metode pembayaran</option>
                    <option value="dana">Pembayaran via Dana</option>
                    <option value="mandiri">Pembayaran via Bank Mandiri</option>
                    <option value="gopay">Pembayaran via Gopay</option>
                </select>
            </div>
            <!-- Unggah Bukti Transfer -->
            <div class="mb-3">
                <label for="bukti" class="form-label">Unggah Bukti Transfer</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
            </div>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary w-100 mb-4">Booking</button>
        </form>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
