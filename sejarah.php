<?php
include 'yoooo.php'; // Ganti dengan require jika Anda ingin header wajib dimuat
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Perusahaan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap">
    <style>
        /* Reset some default browser styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            /* Warna latar belakang */
            margin: 0;
            padding: 0;
            color: #333;
            /* Warna teks */
            overflow-x: hidden;
        }

        .container {
            max-width: 95%;
            /* Diperlebar */
            margin: 0 auto;
            margin-top: 9%;
            padding: 40px;
            background-color: #fff;
            /* Latar belakang putih */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* Bayangan ringan */
            border-radius: 0;
            /* Kotak tajam */
            text-align: left;
            /* Teks sejajar kiri */
            position: relative;
            z-index: 1;
            overflow: hidden;
            /* Untuk efek animasi */
        }

        .history-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 0;
            /* Kotak tajam */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* Bayangan untuk gambar */
        }

        .history-text {
            font-size: 18px;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 20px;
            animation: slideFromLeft 1s ease infinite;
            /* Animasi masuk dari kiri yang berulang-ulang */
        }

        .history-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #e74c3c;
            /* Warna utama - merah */
            animation: slideFromLeft 1s ease infinite;
            /* Animasi masuk dari kiri yang berulang-ulang */
        }

        /* Animasi */
        @keyframes slideFromLeft {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(0);
            }
        }

        /* Responsiveness */
        @media screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require_once 'koneksi.php';

        function tampilSejarah()
        {
            global $koneksi;
            $query = "SELECT id, judul, isi, gambar FROM tentang WHERE id = 2";
            $result = mysqli_query($koneksi, $query);
            return $result;
        }

        $sejarah = tampilSejarah();

        if ($sejarah->num_rows > 0) {
            $row = $sejarah->fetch_assoc();
            $judul = $row['judul'];
            $isi = $row['isi'];
            $gambar = $row['gambar'];

            // Output the dynamic content within your Instagramable structure
            echo '<img src="' . $gambar . '" alt="Sejarah Perusahaan" class="history-image">';
            echo '<h2 class="history-title">' . $judul . '</h2>';
            echo '<div class="history-text">';
            echo '<p>' . $isi . '</p>';
            echo '</div>';
        } else {
            // Data sejarah tidak ditemukan
            echo '<p class="history-text">Tidak ada data sejarah yang ditemukan</p>';
        }
        ?>
    </div>

    <script>
        // Ambil elemen-elemen yang akan dianimasikan
        const historyTitle = document.querySelector('.history-title');
        const historyText = document.querySelector('.history-text');

        // Saat pengguna menggulir ke bawah
        window.addEventListener('scroll', function() {
            // Cek apakah elemen berada di dalam layar
            const titleRect = historyTitle.getBoundingClientRect();
            const textRect = historyText.getBoundingClientRect();

            if (titleRect.top < window.innerHeight && titleRect.bottom >= 0) {
                // Jika elemen judul terlihat, tambahkan animasi
                historyTitle.style.animation = 'slideFromLeft 1s ease';
            }

            if (textRect.top < window.innerHeight && textRect.bottom >= 0) {
                // Jika elemen teks terlihat, tambahkan animasi
                historyText.style.animation = 'slideFromLeft 1s ease';
            }
        });
    </script>
</body>

</html>