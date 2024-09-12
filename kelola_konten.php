<!DOCTYPE html>
<html>

<head>
    <title>Kelola Konten</title>
    <style>
        /* Reset beberapa gaya default browser */
        body {
            background: url('bgs.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Styling untuk konten utama */
        .container {
            background-color: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin: 100px auto;
            padding: 20px;
            max-width: 400px;
        }

        h2 {
            background-color: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        li {
            margin: 20px 0;
        }

        li a {
            background-color: none;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        li a:hover {
            background-color: #eb4034;
        }

        /* Styling untuk tombol "Kembali ke Dashboard" */
        .back-button {
            background-color: none;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #eb4034;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Kelola Konten</h2>
        <ul>
            <li><a href="kelola_header.php">Kelola Header</a></li>
            <li><a href="kelola_body.php">Kelola Body</a></li>
            <li><a href="kelola_footer.php">Kelola Footer</a></li>
        </ul>
        <ul>
            <li><a href="dashboard.php">Kembali ke Dashboard Admin</a></li>
        </ul>

    </div>
</body>

</html>