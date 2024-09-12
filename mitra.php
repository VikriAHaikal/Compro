<!DOCTYPE html>
<html>

<head>
    <title>Logo Mitra</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <style>
        /* Gaya untuk judul "Our Client" */
        .client-title {
            text-align: center;
            /* Pusatkan judul secara horizontal */
            color: white;
            /* Warna teks putih */
            margin-bottom: 30px;
            /* Berikan jarak bawah */
        }

        /* Gaya untuk setiap frame logo */
        .mitra-logos .logo-frame {
            width: 140px;
            /* Lebar frame logo */
            height: 140px;
            /* Tinggi frame logo */
            display: flex;
            justify-content: center;
            /* Pusatkan logo secara horizontal */
            align-items: center;
            /* Pusatkan logo secara vertikal */
            background-color: white;
            /* Warna latar belakang kotak logo */
            border-radius: 10px;
            /* Menambahkan sudut melengkung */
            margin: 10px;
            /* Menambahkan jarak antar frame */
        }

        /* Gaya untuk setiap gambar logo */
        .mitra-logos .logo-frame img {
            max-width: 75%;
            /* Maksimum lebar gambar logo */
            max-height: 75%;
            /* Maksimum tinggi gambar logo */
            object-fit: contain;
            /* Logo sesuai dengan ukuran frame */
        }

        /* Gaya untuk kontainer latar belakang biru */
        .containerlogo {
            background-color: #3372f0;
            /* Warna latar belakang biru yang lebih terang */
            padding: 20px;
            /* Tambahkan ruang padding ke kontainer */
        }
    </style>
</head>

<body>
    <div class="containerlogo"> <!-- Tambahkan div kontainer untuk latar belakang biru -->
        <h1 class="client-title">Our Client</h1>
        <div class="mitra-logos">
            <div class="logo-frame">
                <img src="OTSUKA.png" alt="Mitra 1">
            </div>
            <div class="logo-frame">
                <img src="PANATRADE.jpeg" alt="Mitra 2">
            </div>
            <div class="logo-frame">
                <img src="Polytron.png" alt="Mitra 3">
            </div>
            <div class="logo-frame">
                <img src="PT_SURYA.jpg" alt="Mitra 4">
            </div>
            <div class="logo-frame">
                <img src="makmur_sejahtera.png" alt="Mitra 5">
            </div>
            <div class="logo-frame">
                <img src="POCKHPAN.png" alt="Mitra 6">
            </div>
            <div class="logo-frame">
                <img src="KOPKAR_PEMIPASI.png" alt="Mitra 7">
            </div>
            <div class="logo-frame">
                <img src="KEMENKOP.png" alt="Mitra 7">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.mitra-logos').slick({
                slidesToShow: 7,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2200,
                infinite: true,
                arrows: false, // Menyembunyikan tombol Next dan Previous
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
        });
    </script>
</body>

</html>