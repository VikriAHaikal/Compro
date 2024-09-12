<!DOCTYPE html>
<html>

<head>
    <title>Tentang Koperasi</title>
    <style>
        /* CSS untuk tata letak halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        /* CSS untuk header */
        .header {
            height: 80px;
            color: #fff;
            padding: 20px;
            background-color: #333;
        }

        /* CSS untuk judul */
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        /* CSS untuk video YouTube dan deskripsi */
        .video-description {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Pusatkan konten horizontal di dalam .video-description */
        }

        .video-container {
            flex: 1;
            padding: 0 20px 20px 0;
            margin: 0;
        }

        .video-container iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .description {
            flex: 1;
            padding: 0 0 20px 0;
        }

        .description h1 {
            font-size: 28px;
            color: #333;
            margin-top: 20%;
            margin-bottom: 10px;
            text-align: center; /* Pusatkan judul */
        }

        .description p {
            font-size: 16px;
            color: #666;
            text-align: justify; /* Ratakan teks */
        }

        /* CSS untuk background */
        .background {
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            text-align: center;
        }

        .background h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            text-align: center; /* Pusatkan judul */
        }

        .background p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            text-align: justify; /* Ratakan teks */
        }

        .background ul {
            margin-top: 10px;
            padding-left: 20px;
            text-align: left; /* Ratakan teks daftar */
        }

        .background ul li {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        /* CSS untuk visi dan misi */
        .vision-mission {
            clear: both;
            margin-top: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            text-align: center;
        }

        .vision-mission h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        /* CSS untuk gambar ilustrasi */
        .illustration {
            width: 50%;
            float: left;
            padding: 0 20px 0 0;
        }

        /* CSS untuk struktur organisasi */
        .org-structure {
            clear: both;
            margin-top: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            text-align: center;
        }

        .org-structure h1 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'yoooo.php'; // Ganti dengan require jika Anda ingin header wajib dimuat 
        ?>
    </div>
    <div class="container">
        <div class="video-description">
            <div class="video-container">
                <!-- Video YouTube disini -->
                <iframe src="https://www.youtube.com/embed/W0KIOCt_VA0" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="description">
                <h1>Tentang Koperasi</h1>
                <p>
                    Koperasi Konsumen Karyawan PT Adis Dimension Footwear berkomitmen untuk meningkatkan kesejahteraan anggotanya dan mendukung prinsip-prinsip
                    koperasi, termasuk kerja sama, partisipasi demokratis, dan tanggung jawab sosial.
                </p>
            </div>
        </div>

        <div class="background">
            <h1>Koperasi Konsumen Karyawan PT Adis Dimension Footwear</h1>
            <p>Koperasi Karyawan PT. Adis Dimension Footwear adalah koperasi karyawan, yang berdiri pada Tanggal 11 September tahun 1991 yang berada di Kabupaten Tangerang Balaraja. Koperasi karyawan PT. Adis Dimension Footwear memiliki beberapa unit usaha.</p>
    
            <ul>
                <li>1. Unit Retael</li>
                <li>2. Unit Simpan Pinjam</li>
                <li>3. Unit Jasa</li>
                <li>4. UKM</li>
            </ul>
    
            <p>Koperasi Karyawan PT. Adis beranggota sekitar 8000 anggota. Koperasi Karyawan PT. Adis Dimension Footwear pada tahun 2008 mendapat penghargaan Koperasi terbaik tingkat provinsi banten.</p>
    
            <p>Serta koperasi berprestasi tingkat nasional pada tahun 2014 dari kementerian koperasi dan usaha kecil dan menengah Republik Indonesia.</p>
        </div>

        <div class="vision-mission">
            <h2>Visi</h2>
            <div class="illustration">
                <!-- Gambar ilustrasi visi disini -->
                <img src="gambar-visi.jpg" alt="Ilustrasi Visi">
            </div>
            <p>Teks visi koperasi Anda disini.</p>
        </div>
        <div class="vision-mission">
            <h2>Misi</h2>
            <p>Teks misi koperasi Anda disini.</p>
            <div class="illustration">
                <!-- Gambar ilustrasi misi disini -->
                <img src="gambar-misi.jpg" alt="Ilustrasi Misi">
            </div>
        </div>
        <div class="org-structure">
            <h1>Struktur Organisasi</h1>
            <p>Deskripsi struktur organisasi koperasi Anda disini.</p>
            <!-- Anda dapat menambahkan tabel atau gambar struktur organisasi disini -->
        </div>
    </div>
</body>

</html>
