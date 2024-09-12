<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile News</title>
    <style>
        /* CSS (terserah mau ditambahkan atau diperbarui sesuai kebutuhan) */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 28px;
            color: black;
            text-align: left;
            margin-top: 20px;
            margin-left: 3%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .lihat-berita {
            text-align: right;
            font-size: 18px;
            margin-top: 20px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .container:hover h1,
        .container:hover .lihat-berita {
            opacity: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .highlight {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .news-item {
            flex-basis: calc(33.33% - 20px);
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            overflow: hidden;
            opacity: 0;
            transform: translateY(70px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .news-item.fadeIn {
            opacity: 1;
            transform: translateY(0);
        }

        .news-item:hover img {
            transform: scale(1.05);
            transition: transform 0.5s;
        }

        .news-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .news-content {
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin: 0;
            cursor: pointer;
            text-decoration: none;
            display: inline;
        }

        h2 a {
            text-decoration: none;
            color: #333;
            cursor: pointer;
        }

        h2 a:hover {
            text-decoration: underline;
        }

        .category {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .category-line {
            width: 2px;
            height: 20px;
            background-color: #ddd;
            margin-right: 10px;
        }

        .summary {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .date {
            font-size: 14px;
            color: #666;
        }

        .lihat-berita {
            text-align: right;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rilis Berita</h1>
        <div class="lihat-berita">
            <a href="semua_berita.php">Lihat Berita Lainnya</a>
        </div>

        <div class="highlight">
            <?php
            require 'koneksi.php';

            // Query untuk mengambil data berita dari database
            $sql = "SELECT * FROM berita ORDER BY tanggal_waktu DESC LIMIT 3";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='news-item'>";
                    echo "<img src='{$row['gambar']}' alt='{$row['judul']}' width='300' height='200'>";
                    echo "<div class='news-content'>";
                    echo "<p class='category'><span class='category-line'></span>{$row['kategori']}</p>";

                    $url = "berita.php?id={$row['id']}";
                    echo "<h2><a href='$url'>{$row['judul']}</a></h2>";

                    $isiBerita = substr($row['isi'], 0, 50);
                    if (strlen($row['isi']) > 50) {
                        $isiBerita .= "...";
                    }

                    echo "<p class='summary'>$isiBerita</p>";
                    echo "<p class='date'>{$row['tanggal_waktu']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "Tidak ada berita.";
            }
            ?>
        </div>
    </div>

    <script>
        const newsItems = document.querySelectorAll('.news-item');

        function checkViewport() {
            newsItems.forEach((item) => {
                const itemRect = item.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                if (itemRect.top <= windowHeight && itemRect.bottom >= 0) {
                    item.classList.add('fadeIn');
                } else {
                    item.classList.remove('fadeIn');
                }
            });
        }

        window.addEventListener('load', () => {
            checkViewport();
        });

        window.addEventListener('scroll', () => {
            checkViewport();
        });
    </script>
</body>
</html>
