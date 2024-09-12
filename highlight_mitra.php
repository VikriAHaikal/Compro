<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Koperasi Konsumen Karyawan PT Adis Dimension Footwear</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        .logo-container {
            display: inline-block;
            margin: 10px;
            cursor: pointer;
            border: 2px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: #fff;
            overflow: hidden;
            width: 180px;
            height: 180px;
            transition: transform 0.3s ease;
            /* Efek transisi dengan durasi 0.3 detik */
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 100%;
            height: 100%;
        }

        .deskripsi {
            display: none;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

     

    </style>
</head>

<body>
    <h1>Mitra Koperasi Konsumen Karyawan PT Adis Dimension Footwear</h1>

    <h2> Mitra Kami</h2>
        <div class="logo-container" onclick="showDeskripsi('mitra1')">
            <img class="logo" src="mitra1-logo.jpg" alt="Mitra 1">
            <p class="deskripsi" id="mitra1">Deskripsi Mitra 1</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('mitra2')">
            <img class="logo" src="mitra2-logo.jpg" alt="Mitra 2">
            <p class="deskripsi" id="mitra2">Deskripsi Mitra 2</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('mitra3')">
            <img class="logo" src="mitra3-logo.jpg" alt="Mitra 3">
            <p class="deskripsi" id="mitra3">Deskripsi Mitra 3</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('mitra4')">
            <img class="logo" src="mitra4-logo.jpg" alt="Mitra 4">
            <p class="deskripsi" id="mitra4">Deskripsi Mitra 4</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('mitra5')">
            <img class="logo" src="mitra5-logo.jpg" alt="Mitra 5">
            <p class="deskripsi" id="mitra5">Deskripsi Mitra 5</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('mitra6')">
            <img class="logo" src="mitra6-logo.jpg" alt="Mitra 6">
            <p class="deskripsi" id="mitra6">Deskripsi Mitra 6</p>
        </div>
    </div>

    <h2>Partner Kami</h2>
        <div class="logo-container" onclick="showDeskripsi('partner1')">
            <img class="logo" src="partner1-logo.jpg" alt="Partner 1">
            <p class="deskripsi" id="partner1">Deskripsi Partner 1</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('partner2')">
            <img class="logo" src="partner2-logo.jpg" alt="Partner 2">
            <p class="deskripsi" id="partner2">Deskripsi Partner 2</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('partner3')">
            <img class="logo" src="partner3-logo.jpg" alt="Partner 3">
            <p class="deskripsi" id="partner3">Deskripsi Partner 3</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('partner4')">
            <img class="logo" src="partner4-logo.jpg" alt="Partner 4">
            <p class="deskripsi" id="partner4">Deskripsi Partner 4</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('partner5')">
            <img class="logo" src="partner5-logo.jpg" alt="Partner 5">
            <p class="deskripsi" id="partner5">Deskripsi Partner 5</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('partner6')">
            <img class="logo" src="partner6-logo.jpg" alt="Partner 6">
            <p class="deskripsi" id="partner6">Deskripsi Partner 6</p>
        </div>
    </div>

    <h2>Support Kami</h2>
        <div class="logo-container" onclick="showDeskripsi('support1')">
            <img class="logo" src="support1-logo.jpg" alt="Support 1">
            <p class="deskripsi" id="support1">Deskripsi Support 1</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('support2')">
            <img class="logo" src="support2-logo.jpg" alt="Support 2">
            <p class="deskripsi" id="support2">Deskripsi Support 2</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('support3')">
            <img class="logo" src="support3-logo.jpg" alt="Support 3">
            <p class="deskripsi" id="support3">Deskripsi Support 3</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('support4')">
            <img class="logo" src="support4-logo.jpg" alt="Support 4">
            <p class="deskripsi" id="support4">Deskripsi Support 4</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('support5')">
            <img class="logo" src="support5-logo.jpg" alt="Support 5">
            <p class="deskripsi" id="support5">Deskripsi Support 5</p>
        </div>

        <div class="logo-container" onclick="showDeskripsi('support6')">
            <img class="logo" src="support6-logo.jpg" alt="Support 6">
            <p class="deskripsi" id="support6">Deskripsi Support 6</p>
        </div>
    </div>

</body>

</html>
