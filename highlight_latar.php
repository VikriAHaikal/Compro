<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latar Belakang Perusahaan - Koperasi Karyawan PT. Adis Dimension Footwear</title>
    <style>
        /* CSS untuk latar_belakang.php */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .containerl {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 30px;
        }

        /* Efek fade dan zoom in saat hover ke gambar */
        .containerl img {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            object-fit: cover;
            margin-right: -40px;
            opacity: 1; /* Ubah opasitas menjadi 1 */
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .containerl img:hover {
            transform: scale(1.05); /* Efek zoom-in saat cursor mengarah ke gambar */
            opacity: 0.8;
        }

        /* Gaya latar_belakang.php */
        .contenttu {
            flex: 1;
            padding-left: 20px;
        }

        .containerl .contenttu h1 {
            font-size: 28px;
            color: black;
            margin-bottom: 20px;
            margin-left: -35px;
            /* Mengatur jarak margin kiri */
            position: relative;
            /* Menambahkan posisi relatif untuk garis */
        }

        .containerl .contenttu h1::after {
            content: "";
            position: absolute;
            top: 17px;
            left: 54%;
            color:black;
            /* Panjang garis sepanjang 30px */
            height: 10%;
            width: 297px;
            background-color: #3385f0;
            /* Warna garis */
        }

        .containerl .contenttu p {
            font-size: 16px;
            color: black;
            line-height: 1.6;
            margin-left: -35px;
            /* Mengatur jarak margin kiri */
        }

        /* Gaya tombol Selengkapnya */
        .read-more-button {
            display: inline-block;
            background-color: #3385f0;
            color: #fff;
            padding: 10px 17px;
            text-decoration: none;
            margin-top: 10px;
            margin-left: -35px;
        }

        /* Gaya tombol Selengkapnya saat digerakkan */
        .read-more-button:hover {
            background-color: #0056b3;
        }

        /* Animasi slide bersamaan */
        @keyframes slideInRight {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .containerl .contenttu h1,
        .containerl .contenttu p,
        .read-more-button {
            animation: slideInRight 1s ease forwards;
        }
    </style>
</head>

<body>
    <!-- Tambahkan header, menu navigasi, dan elemen-elemen desain situs web Anda di sini -->

    <section id="latar-belakang">
        <div class="containerl">
            <div class="contenttu">
                <h1>Latar Belakang Koperasi</h1>
                <p>
                    Koperasi Karyawan PT. Adis Dimension Footwear adalah koperasi karyawan yang berdiri pada Tanggal 11 September tahun 1991 dan berlokasi di Kabupaten Tangerang, Balaraja.
                </p>
                <a href="tentang_kami.php" class="read-more-button">Selengkapnya</a>
            </div>
            <img src="con.jpg" alt="Gambar Perusahaan">
        </div>
    </section>
</body>
</html>
