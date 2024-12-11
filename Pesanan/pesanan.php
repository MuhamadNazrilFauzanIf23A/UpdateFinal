<?php
session_start();

// Periksa apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['role'] === 'user';

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Zahrarental</title>
    <meta name="description" content="Pesan kendaraan pilihan Anda dengan mudah di Zahrarental. Tersedia berbagai jenis mobil untuk kebutuhan perjalanan Anda.">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- css -->
    <link href="../css/pesan.css" rel="stylesheet">
</head>
<body>
      <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container">
    <a class="navbar-brand fs-4 " href="../Final.php">Zahrarental</a>
    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Sidebar -->
    <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header" style="border-bottom: 1px solid black;">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Zahrarental</h5>
        <button type="button" class="btn-close btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <!-- sidebar body -->
      <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
        <ul class="navbar-nav justify-content-center align-items-center fs-6 flex-grow-1 pe-3">
          <li class="nav-item mx-2">
            <a class="nav-link active" aria-current="page" href="../Final.php">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="../AboutRental/About.php">About rental</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="../Contact/contact.php">Contact</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pesanan.php">Pemesanan</a>
          </li>
        </ul>
        <!-- Login/sign up -->
         <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
          <a href="../Login/loginnew.php" class="text-black">Login</a>
          <a href="../Login/register.php" class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4">Sign up</a>
        </div>
      </div>
    </div>
  </div>
</nav>

    <!-- Hero Section -->
    <div class="hero-section mt-5">
        <h1>Pemesanan Kendaraan</h1>
        <p>Pesan kendaraan dengan mudah dan cepat sesuai kebutuhan Anda.</p>
    </div>

    <!-- Form Section -->
    <div class="container form-section">
        <form action="submit_order.php" method="post" class="p-4 bg-light rounded-3 shadow">
            <h4 class="mb-4">Formulir Pemesanan</h4>
            <div class="mb-3">
                <label for="carType" class="form-label">Pilih Jenis Kendaraan</label>
                <select class="form-select" id="carType" name="carType" required>
                    <option value="" selected disabled>Pilih kendaraan...</option>
                    <option value="sedan">Sedan</option>
                    <option value="suv">SUV</option>
                    <option value="mpv">MPV</option>
                    <option value="luxury">Mobil Mewah</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="pickupDate" class="form-label">Tanggal Jemput</label>
                <input type="date" class="form-control" id="pickupDate" name="pickupDate" required>
            </div>
            <div class="mb-3">
                <label for="pickupTime" class="form-label">Waktu Jemput</label>
                <input type="time" class="form-control" id="pickupTime" name="pickupTime" required>
            </div>
            <div class="mb-3">
                <label for="returnDate" class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="returnDate" name="returnDate" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi Penjemputan</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Masukkan lokasi..." required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Catatan Tambahan (Opsional)</label>
                <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Tambahkan catatan..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
        </form>
</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
