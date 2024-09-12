<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['nama'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: form_login.php');
    exit();
}

// Periksa waktu sesi
$sessionTime = 1800; // 30 menit dalam detik
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTime)) {
    // Jika waktu sesi lebih dari 30 menit, hapus sesi dan redirect ke halaman login
    session_unset();
    session_destroy();
    header('Location: form_login.php');
    exit();
}

// Update waktu sesi setiap kali halaman di-refresh
$_SESSION['last_activity'] = time();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Super Admin</title>
    <style>
        /* Reset beberapa gaya default browser */
        body {
            background: url('bgs.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: none;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 20px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #eb4034;
        }

        /* Main Content Styling */
        main {
            padding: 20px;
            margin-left: -250px;
            /* Mengubah margin menjadi negatif saat sidebar tertutup */
            transition: margin-left 0.5s;
        }

        /* Footer Styling */
        footer {
            background-color: none;
            color: #fff;
            text-align: left;
            /* Menggeser teks ke kanan */
            padding: 10px 20;
            /* Menyesuaikan padding */
            position: absolute;
            bottom: 0;
            width: 100%;
            margin-bottom: 0px;
            /* Menambah margin bawah sedikit */
        }

        /* Styling for the toggle button */
        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 2;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="mySidebar">
        <a href="kelola_akun.php">Kelola Akun</a>
        <a href="kelola_konten.php">Kelola Konten</a>
        <a href="#" id="logout-link" onclick="confirmLogout()">Logout</a>

    </div>

    <!-- Toggle button -->
    <span class="menu-icon" id="toggleBtn" onclick="toggleSidebar()">&#9776;</span>

    <!-- Main Content -->
    <main id="main">
        <!-- Isi konten utama Anda di sini -->
    </main>

    <!-- Footer -->
    <footer>
        <p>Hak Cipta © 2023 Koperasi Konsumen Karyawan PT Adis Dimension Footwear</p>
    </footer>

    <script>
        var sidebarOpen = false; // Menandakan apakah sidebar terbuka atau tidak

        // Fungsi untuk mengubah status sidebar
        function toggleSidebar() {
            if (sidebarOpen) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }

        // Fungsi untuk membuka sidebar
        function openSidebar() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "0"; // Mengubah margin saat sidebar terbuka
            document.getElementById("toggleBtn").innerHTML = "&#9776;"; // Mengganti ikon menjadi tiga garis
            sidebarOpen = true;
        }

        // Fungsi untuk menutup sidebar
        function closeSidebar() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "-250px"; // Mengubah margin saat sidebar tertutup
            document.getElementById("toggleBtn").innerHTML = "✖"; // Mengganti ikon menjadi tanda silang (✖)
            sidebarOpen = false;
        }

        // Konfirmasi logout
        function confirmLogout() {
            var confirmLogout = confirm("Apakah Anda yakin ingin logout?");
            if (confirmLogout) {
                window.location.href = "form_login.php"; // Ganti dengan URL logout Anda
            }
            // Jangan lakukan apa pun jika pengguna membatalkan logout
            return false; // Ini akan mencegah tindakan default dari tautan
        }
    </script>
</body>

</html>