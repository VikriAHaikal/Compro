<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highlight Produk - Koperasi Karyawan</title>
    <style>
        /* Reset beberapa default styling browser */
        body,
        h1,
        h2,
        p {
            margin: 0;
            padding: 0;
        }

        /* Pengaturan font */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }

        /* Gaya untuk judul "Produk Koperasi" */
        .judul-produk h1 {
            font-size: 28px;
            margin: 50px 20px 20px 20px;
            font-family: 'Arial', sans-serif;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 2px;
        }


        /* Container produk */
        .highlighted-products-container {
            margin: 20px;
        }

        /* Container produk */
        .highlighted-products {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            /* Ubah nilai grid-gap sesuai dengan preferensi Anda */
        }


        /* Gaya untuk setiap produk */
        .product {
            position: relative;
            background-color: #ddd;
            padding: 0;
            text-align: center;
            height: 250px;
            overflow: hidden;
        }

        .product .image {
            background-size: cover;
            background-position: center;
            height: 100%;
            transition: transform 0.5s ease-in-out;
            /* Efek zoom in yang lebih smooth */
        }

        .product:hover .image {
            transform: scale(1.05);
            /* Efek zoom in saat hover */
        }


        .product .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .product h2 {
            font-size: 24px;
            margin: 10px 0;
            color: white
        }

        .product p {
            font-size: 16px;
            margin: 0;
            color: white
        }
    </style>
</head>

<body>
    <section>
        <div class="judul-produk">
            <h1>Produk Koperasi</h1>
        </div>

        <div class="highlighted-products-container">
            <div class="highlighted-products">
                <!-- Tampilkan 4 produk atau layanan unggulan di sini -->
                <div class="product">
                    <div class="image" style="background-image: url('USP.jpg');"></div>
                    <div class="overlay">
                        <h2>Unit Simpan Pinjam</h2>
                        <p>Deskripsi singkat mengenai Produk 1.</p>
                    </div>
                </div>

                <div class="product">
                    <div class="image" style="background-image: url('JASA1.jpg');"></div>
                    <div class="overlay">
                        <h2>Unit Jasa</h2>
                        <p>Deskripsi singkat mengenai Produk 2.</p>
                    </div>
                </div>

                <div class="product">
                    <div class="image" style="background-image: url('supermarket.jpg');"></div>
                    <div class="overlay">
                        <h2>Unit Retail</h2>
                        <p>Deskripsi singkat mengenai Produk 3.</p>
                    </div>
                </div>

                <div class="product">
                    <div class="image" style="background-image: url('UMKM.jpg');"></div>
                    <div class="overlay">
                        <h2>UKM</h2>
                        <p>Deskripsi singkat mengenai Produk 4.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include your JavaScript code here if needed -->

</body>

</html>