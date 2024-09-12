<?php
require 'koneksi.php';
include 'yoooo.php';
// Ambil nilai kategori dari parameter URL
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 100px auto;
            padding: 20px;
        }

        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .kategori-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .kategori-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .kategori-list-item {
            font-size: 16px;
            color: #333;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .kategori-list-item:hover,
        .kategori-list-item.active {
            background-color: #ddd !important;
        }

        .news-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .blog-post {
            flex-basis: calc(33.33% - 20px);
            background-color: #fff;
            border: 1px solid #ddd;
            overflow: hidden;
            transition: transform 0.5s ease;
            position: relative;
        }

        .blog-post:hover {
            transform: scale(1.05);
        }

        .news-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            background-size: cover;
            position: relative;
        }

        .news-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .news-details {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            box-sizing: border-box; /* Menambahkan properti box-sizing */
            color: white;
            text-align: left;
        }

        .news-details .date {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .news-details .judul a {
            font-size: 18px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .news-content {
            display: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <!-- Judul Berita -->
        <div class="title-container">
            <h2 class="kategori-title">Berita - <?php echo $kategori; ?></h2>
        </div>

        <!-- Kategori Berita -->
        <div class="kategori-container">
            <ul class="kategori-list">
                <li class='kategori-list-item <?php echo ($kategori == "Semua") ? "active" : ""; ?>' onclick='filterByCategory("Semua")'>Semua</li>
                <li class='kategori-list-item <?php echo ($kategori == "Pendidikan") ? "active" : ""; ?>' onclick='filterByCategory("Pendidikan")'>Pendidikan</li>
                <li class='kategori-list-item <?php echo ($kategori == "Sosial") ? "active" : ""; ?>' onclick='filterByCategory("Sosial")'>Sosial</li>
                <li class='kategori-list-item <?php echo ($kategori == "Teknologi") ? "active" : ""; ?>' onclick='filterByCategory("Teknologi")'>Teknologi</li>
                <li class='kategori-list-item <?php echo ($kategori == "Lainnya") ? "active" : ""; ?>' onclick='filterByCategory("Lainnya")'>Lainnya</li>
            </ul>
        </div>

          <!-- Menampilkan Berita Sesuai Kategori -->
          <div class="news-container">
            <?php
            $sql = "SELECT * FROM berita";
            
            // Filter berita berdasarkan kategori jika bukan Semua
            if ($kategori != 'Semua') {
                $sql .= " WHERE kategori = '$kategori'";
            }

            $sql .= " ORDER BY tanggal_waktu DESC";

            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Mengambil ID berita
                    $beritaID = $row['id'];
                    // Membuat URL untuk halaman berita.php dengan menyertakan ID sebagai parameter
                    $url = "berita.php?id={$beritaID}";

                    echo "<div class='blog-post' data-category='{$row['kategori']}'>";
                    echo "<div class='news-image' style='background-image: url(\"{$row['gambar']}\")'>";
                    echo "<div class='news-details'>";
                    $tanggal = date_create($row['tanggal_waktu']);
                    $nama_bulan = date_format($tanggal, 'd F Y');
                    // Mengganti judul dengan tautan ke berita.php
                    echo "<span class='date'>{$nama_bulan}</span><div class='judul'><a href='{$url}'>{$row['judul']}</a></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<p class='news-content'>{$row['isi']}</p>";
                    echo "</div>";
                }
            } else {
                echo "Tidak ada berita yang ditemukan.";
            }
            ?>
        </div>

    </div>

    <script>
        function filterByCategory(category) {
            const blogPosts = document.querySelectorAll('.blog-post');
            const categoryItems = document.querySelectorAll('.kategori-list-item');

            categoryItems.forEach(item => {
                item.classList.remove('active');
            });

            blogPosts.forEach(post => {
                const postCategory = post.getAttribute('data-category');
                if (category === postCategory || category === "Semua") {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });

            const selectedCategory = document.querySelector(`.kategori-list-item[data-category="${category}"]`);
            if (selectedCategory) {
                selectedCategory.classList.add('active');
            }
        }
    </script>

</body>

</html>