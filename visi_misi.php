<?php
include 'yoooo.php'; // Ganti dengan require jika Anda ingin header wajib dimuat
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi Perusahaan</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap">
    <style>
        
        /* Reset some default browser styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 95%;
            margin: 0 auto;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 0;
            text-align: left;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .vision-mission {
            margin-bottom: 40px;
            margin-top: 70px;
            background-color: rgba(255, 255, 255, 0.6);
            /* Latar belakang putih dengan tingkat transparansi lebih tinggi */
            background-size: contain;
            /* Mengatur ukuran gambar agar menutupi seluruh elemen */
            background-repeat: no-repeat;
            background-position: center center;
            min-height: 300px;
            /* Tinggi minimum kontainer agar konten tampil dengan baik */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .vision-mission h2 {
            font-size: 40px;
            font-weight: bold;
            color: black;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .vision-mission p {
            font-size: 20px;
            font-weight: bold 40%;
            margin-left: 40px;
            line-height: 1.6;
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .vision-mission ul {
            list-style-type: square;
            padding-left: 20px;
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .vision-mission li {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 10px;
            margin-top: 30px;
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

        function tampilVisiMisi()
        {
            global $koneksi;
            $query = "SELECT id, judul, isi FROM tentang WHERE id = 3";
            $result = mysqli_query($koneksi, $query);
            return $result;
        }

        function tampilGambar()
        {
            global $koneksi;
            $query = "SELECT gambar FROM tentang WHERE id = 3";
            $result = mysqli_query($koneksi, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $gambar = $row['gambar'];

                // Tampilkan latar belakang dengan URL gambar dan tingkat transparansi lebih tinggi, serta ukuran gambar
                echo 'style="background-image: url(\'' . $gambar . '\'); background-color: rgba(255, 255, 255, 0.6); background-size: contain; background-repeat: no-repeat; background-position: center;"';
            } else {
                echo 'style="background-color: rgba(255, 255, 255, 0.6);"'; // Fallback jika gambar tidak ditemukan
            }
        }

        $visiMisi = tampilVisiMisi();

        if ($visiMisi->num_rows > 0) {
            $row = $visiMisi->fetch_assoc();
            $judul = $row['judul'];
            $isi = $row['isi'];

            echo '<div class="vision-mission" ';
            tampilGambar();
            echo '>';
            echo '<h2>' . $judul . '</h2>';
            $misiItems = explode("\n\n", $isi);
            foreach ($misiItems as $item) {
                echo '<p>' . nl2br(trim($item)) . '</p>';
            }
            echo '</div>';
        } else {
            echo '<p class="vision-mission">Tidak ada data visi dan misi yang ditemukan.</p>';
        }
        ?>
    </div>
    <script>
      
        $(document).ready(function() {
            // Ambil kontainer visi dan misi
            var visionMissionContainer = $(".vision-mission");

            // Sembunyikan kontainer visi dan misi
            visionMissionContainer.hide();

            // Tampilkan kontainer dengan efek fadeIn
            visionMissionContainer.fadeIn(1000); // 1000 ms = 1 detik
        });
    </script>

</body>

</html>