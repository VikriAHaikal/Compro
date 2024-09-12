<?php
require 'koneksi.php';

function tambahWarna($nama, $kode_warna)
{
    global $koneksi;
    $sql = "INSERT INTO warna (nama, kode_warna) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $nama, $kode_warna);
    return mysqli_stmt_execute($stmt);
}

function tampilDataWarna()
{
    global $koneksi;
    $query = "SELECT id, nama, kode_warna FROM warna";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

function ubahWarna($id, $nama, $kode_warna)
{
    global $koneksi;
    $sql = "UPDATE warna SET nama=?, kode_warna=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $nama, $kode_warna, $id);
    return mysqli_stmt_execute($stmt);
}

function hapusWarna($id)
{
    global $koneksi;
    $sql = "DELETE FROM warna WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    return mysqli_stmt_execute($stmt);
}

$editMode = false;

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kode_warna = $_POST['kode_warna'];

    if (tambahWarna($nama, $kode_warna)) {
        header("Location: kelola_warna.php");
        exit();
    } else {
        echo '<div class="notification">Gagal menambahkan data warna.</div>';
    }
}

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $query = "SELECT * FROM warna WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $edit_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $edit_nama = $row['nama'];
        $edit_kode_warna = $row['kode_warna'];
        $editMode = true;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo '<script>
        var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
        if(konfirmasi){
            window.location.href = "kelola_warna.php?delete_confirmed=' . $id . '";
        }
    </script>';
}

if (isset($_GET['delete_confirmed'])) {
    $id = $_GET['delete_confirmed'];
    if (hapusWarna($id)) {
        header("Location: kelola_warna.php");
        exit();
    } else {
        echo '<div class="notification">Gagal menghapus data warna.</div>';
    }
}

if (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $nama = $_POST['nama'];
    $kode_warna = $_POST['kode_warna'];

    if (ubahWarna($edit_id, $nama, $kode_warna)) {
        header("Location: kelola_warna.php");
        exit();
    } else {
        echo '<div class="notification">Gagal mengubah data warna.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warna</title>
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
            background-color: rgba(0, 0, 0, 0.0);
            /* Warna latar belakang dengan transparansi */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin: 50px auto;
            /* Margin atas dan bawah dikurangi */
            padding: 20px;
            max-width: 600px;
            /* Lebar maksimum ditingkatkan */
        }

        h1 {
            color: #fff;
        }

        /* Form styling */
        form {
            text-align: left;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        input[type="text"],
        input[type="color"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid rgba(0, 0, 0, 0.0);
            border-radius: 3px;
            font-size: 14px;
            background: rgba(0, 0, 0, 0.0);
            color: #fff;
        }

        button[type="submit"] {
            background-color: #5f5380;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: none;
            /* Warna background hover yang lebih terang */
        }

        /* Menampilkan daftar data warna */
        .color-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .color-item {
            background-color: none;
            /* Warna latar belakang dengan transparansi */
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            text-align: center;
            padding: 10px;
            margin: 10px;
        }

        .color-item .color-box {
            width: 50px;
            height: 50px;
            margin: 10px auto;
        }

        .color-item a {
            display: block;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .color-item a:hover {
            color: #eb4034;
            /* Warna teks hover sesuai dominan #eb4034 */
        }

        /* Tombol untuk kembali ke halaman lain */
        .back-button {
            background-color: none;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #eb4034;
            /* Warna background hover yang lebih terang */
        }

        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #5f5380;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            z-index: 9999;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Warna</h1>
        <form method="POST">
            <?php if ($editMode) : ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                <label>Nama Warna:</label>
                <input type="text" name="nama" value="<?php echo $edit_nama; ?>"><br>
                <label>Kode Warna:</label>
                <input type="color" name="kode_warna" value="<?php echo $edit_kode_warna; ?>"><br>
                <button type="submit" name="update">Update Data</button>
                <button type="button" onclick="batalEdit()">Batal</button>
            <?php else : ?>
                <label>Nama Warna:</label>
                <input type="text" name="nama"><br>
                <label>Kode Warna:</label>
                <input type="color" name="kode_warna"><br>
                <button type="submit" name="submit">Tambah Data</button>
            <?php endif; ?>
        </form>

        <div class="color-list">
            <?php
            $data = tampilDataWarna();
            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    echo "<div class='color-item'>";
                    echo "<div class='color-box' style='background-color: " . $row['kode_warna'] . "'></div>";
                    echo "<p style='color: white;'>" . $row["nama"] . "</p>";
                    echo '<a href="?edit=' . $row["id"] . '" style="color: white;">Edit</a>';
                    echo '<a href="?delete=' . $row["id"] . '" style="color: white;">Hapus</a>';
                    echo "</div>";
                }
            } else {
                echo "<p style='color: white;'>Tidak ada data yang ditemukan dalam tabel Warna.</p>";
            }
            ?>
        </div>

        <a href="kelola_header.php" class="back-button">Kembali ke Kelola Header</a>
    </div>
    <!-- Tambahkan JavaScript Anda di sini -->
    <script>
        function batalEdit() {
            // Kembalikan ke tampilan awal untuk menambahkan file
            window.location.href = 'kelola_warna.php';
        }
    </script>
</body>
</html>
