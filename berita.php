<?php
include 'yoooo.php'; // Ganti dengan require jika Anda ingin header wajib dimuat
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile News</title>
    <style>
        /* CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            margin-right: 17%;
            margin-top: 9%;
        }

        .news-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            /* Tambahkan margin bawah untuk memisahkan judul dan detail */
        }

        /* CSS */
        .news-details {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .news-details .category,
        .news-details .date,
        .news-details .penulis {
            font-size: 16px;
            color: #666;
            margin-right: 18px;
            /* Tambahkan margin-right yang lebih kecil */
            display: flex;
            align-items: center;
            /* Membuat konten horizontal sejajar */
        }

        .news-details .category i,
        .news-details .date i,
        .news-details .penulis i {
            color:
                #3385f0;
            /* Warna kuning untuk ikon kategori, tanggal, dan penulis */
            margin-right: 5px;
            /* Tambahkan margin-right untuk memberi jarak antara ikon dan teks */
        }

        .news-image {
            max-width: 100%;
            max-height: 400px;
            /* Atur tinggi maksimum yang Anda inginkan */
            height: auto;
            display: block;
            margin: 20px 0;
        }

        .news-content {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            text-align: left;
            /* Membuat isi berita menjadi rata kiri */
        }

        /* Teks "Kembali ke Berita" */
        .back-link {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>


</head>

<body>
    <div class="container">
        <?php
        require 'koneksi.php'; // Sertakan file koneksi.php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Query untuk mengambil berita berdasarkan ID
            $sql = "SELECT * FROM berita WHERE id = $id";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<h1 class='news-title'>{$row['judul']}</h1>";
                echo "<div class='news-details'>";
                echo "<div class='category'><i class='fas fa-bookmark text-warning'></i>  {$row['kategori']}</div>";
                // Ubah format tanggal MySQL ke nama bulan
                $tanggal = date_create($row['tanggal_waktu']);
                $nama_bulan = date_format($tanggal, 'd F Y, H:i'); // Format tanggal seperti "01 Januari 2023, 15:30"
                echo "<div class='date'><i class='far fa-clock text-warning'></i>  {$nama_bulan}</div>";
                echo "<div class='penulis'><i class='far fa-user text-warning'></i> Oleh: {$row['penulis']}</div>";
                echo "</div>";
                echo "<img src='{$row['gambar']}' alt='{$row['judul']}' class='news-image'>";
                echo "<p class='news-content'>{$row['isi']}</p>";
            } else {
                echo "Berita tidak ditemukan.";
            }
        } else {
            echo "ID berita tidak ditemukan dalam URL.";
        }
        ?>
    </div>

</body>

</html>