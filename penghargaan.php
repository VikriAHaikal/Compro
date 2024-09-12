<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghargaan Perusahaan</title>
    <style>
        /* Reset some default styles for consistency */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        /* Style the main content */
        main {
            padding: 20px;
            text-align: center;
        }

        .awards-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 kolom dalam satu baris */
            gap: 20px;
            margin-top: 70px;
        }

        .award {
            background-color: #fff;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .award:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        .award img {
            margin-top: 20px;
            max-width: 100%;
            max-height: 250px;
            width: auto;
        }

        .award-info {
            padding: 20px;
        }

        .award-info h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .award-info p {
            font-size: 18px;
            color: #777;
        }
    </style>
</head>

<body>
    <main>
        <h2>Penghargaan Kami</h2>
        <div class="awards-container">
            <?php
            require 'koneksi.php'; // Sertakan file koneksi.php

            // Query untuk mengambil data penghargaan dari database dan mengurutkannya berdasarkan tahun terbaru
            $query = "SELECT * FROM penghargaan ORDER BY tahun DESC"; // Sesuaikan dengan nama tabel Anda


            // Eksekusi query
            $result = $koneksi->query($query);

            // Tampilkan data penghargaan
            while ($row = $result->fetch_assoc()) {
                echo '<div class="award">';
                echo '<img src="' . $row['gambar'] . '" alt="' . $row['keterangan'] . '">';
                echo '<div class="award-info">';
                echo '<h3>' . $row['keterangan'] . '</h3>';
                echo '<p>Tingkat: ' . $row['tingkat'] . '</p>';
                echo '<p>Tahun: ' . $row['tahun'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </main>
</body>

</html>