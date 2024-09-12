<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Koperasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-XXXXX" crossorigin="anonymous" />
    <style>
        /* Gaya untuk footer */
        .footer {
            background-color: #002147;
            color: white;
            font-size: 14px;
            padding-top: 50px;
            padding-bottom: 20px;
            position: relative;
        }

        .containerfut {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .footer-column {
            flex: 1;
            margin: 0 20px;
        }

        .footer-column h4 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        address {
            font-style: normal;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        /* Elemen div.foot::before */
        .footer::before {
            content: "";
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background-color: #002147;
        }

        /* Elemen div.foot::after */
        .footer::after {
            content: "";
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background-color: #002147;
        }

        /* Elemen div.footer-body */
        .footer-body {
            background-color: #f2f2f2;
            padding: 40px 0;
            color: #333;
            font-size: 16px;
            text-align: center;
            /* Tambahkan untuk konsistensi */
        }


        .footer-body .containerfut {
            flex-direction: column;
            align-items: center;
        }

        .footer-body .kopkar-logo {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        .footer-body .social-icons {
            margin-top: 20px;
        }

        .footer-body .social-icons a {
            margin-right: 20px;
            font-size: 24px;
            color: #002147;
        }

        /* Elemen div.text-center */
        .text-center {
            text-align: center;
        }

        /* Elemen div.footer-copyright */
        .footer-copyright {
            background-color: #002147;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

        .footer-copyright p {
            margin: 0;
        }

        .kopkar-logo {
            width: 140px;
            /* Lebar frame */
            height: 140px;
            /* Tinggi frame */
            padding: 10px;
            /* Jarak antara gambar dan frame */
            box-sizing: border-box;
            /* Membuat padding termasuk dalam ukuran total */
            margin-bottom: 20px;
        }


        .gmaps h4 {
            font-size: 18px;
            margin-bottom: 15px;
        }

    </style>
</head>

<body>
    <div class="footer">
        <div class="containerfut">
            <div class="footer-content">
                <div class="footer-column">
                    <img src="kopkars.png" alt="Logo Koperasi" class="kopkar-logo">
                    <h4>Tentang Kami</h4>
                    <ul>
                        <li><a href="#">Sejarah</a></li>
                        <li><a href="#">Visi & Misi</a></li>
                        <li><a href="#">Struktur Organisasi</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Produk Usaha</h4>
                    <ul>
                        <li><a href="#">Unit Retail</a></li>
                        <li><a href="#">Unit Simpan Pinjam</a></li>
                        <li><a href="#">Unit Jasa</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Kontak</h4>
                    <address>
                        Jalan Raya Serang Km 24 Balaraja Tangerang <br> Indonesia
                    </address>
                    <a href="tel:+622122595318">(021) 22595318</a>
                    <br>
                    <a href="mailto:kopkar@koperasi-adis.co.id">kopkar@koperasi-adis.co.id</a>
                </div>
                <div class="footer-column">
                    <h4>Media Sosial</h4>
                    <ul>
                        <li><a href="https://www.instagram.com/kopkaradis_official/" target="_blank">@kopkaradis_official</a></li>
                        <li><a href="https://www.instagram.com/adismartofficial/" target="_blank">@adismartofficial</a></li>
                        <li><a href="https://youtube.com/@koperasiadis2278" target="_blank">koperasi adis</a></li>
                        <li><a href="https://wa.me/6287777883993" target="_blank">WA: 087777883993</a></li>
                    </ul>
                </div>

                <!-- Tambahkan peta Google Maps di sebelah kanan -->
                <div class="gmaps">
                    <h4>Lokasi Kami</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8803363448126!2d106.4534763!3d-6.19874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a231015f37843%3A0xe32d383089a2ac8c!2sAgenpos%20Kopkar%20Adis!5e0!3m2!1sen!2sid!4v1643979598432!5m2!1sen!2sid&markers=-6.19874,106.4534763" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>


            </div>
        </div>
    </div>

    <!-- Bagian footer yang ingin disamakan -->
    <div class="footer-body">
        <div class="containerfut">

            <p>
                Koperasi Konsumen Karyawan PT Adis Dimension Footwear adalah Koperasi terkemuka di Indonesia yang
                berkomitmen untuk memberikan layanan yang berkualitas.
            </p>
            <div class="social-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Bagian footer hak cipta -->
    <div class="footer-copyright">
        <div class="containerfut">
            <p>&copy; Copyright © 2023 Koperasi Konsumen Karyawan PT Adis Dimension Footwear</p>
        </div>
    </div>
</body>

</html>