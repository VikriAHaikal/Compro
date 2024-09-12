<?php
require_once 'koneksi.php';

function getCompanyLogos()
{
    global $koneksi;
    $query = "SELECT * FROM company_logo";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

// Inisialisasi variabel
$editMode = false;
$logo = null;
$notification = '';

if (isset($_POST['tambah_logo'])) {
    $company_id = $_POST['company_id'];

    // Cek apakah ada file yang diunggah
    if (isset($_FILES["logo_perusahaan"])) {
        $file = $_FILES["logo_perusahaan"];
        $file_name = $file["name"];
        $file_tmp = $file["tmp_name"];
        $file_size = $file["size"];

        // Lokasi penyimpanan file
        $uploadDirectory = "uploads/";

        // Batasan ukuran file (2 MB)
        $maxFileSize = 2 * 1024 * 1024; // 2 MB dalam byte

        // Format file yang diizinkan
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        // Mendapatkan ekstensi file
        $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions) && $file_size <= $maxFileSize) {
            // File adalah gambar yang valid
            $targetFile = $uploadDirectory . $file_name;

            if (move_uploaded_file($file_tmp, $targetFile)) {
                // File telah diunggah dengan sukses, simpan nama file dalam database
                $logo_perusahaan = $targetFile;

                $query = "INSERT INTO company_logo (company_id, logo_perusahaan) VALUES (?, ?)";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, 'is', $company_id, $logo_perusahaan);
                mysqli_stmt_execute($stmt);

                // Set notifikasi
                $notification = 'Logo berhasil ditambahkan.';
            } else {
                $notification = 'Gagal mengunggah file logo.';
            }
        } else {
            $notification = 'File logo tidak valid atau terlalu besar.';
        }
    }
}

if (isset($_GET['hapus_logo'])) {
    $logo_id = $_GET['hapus_logo'];

    // Hapus logo dari database
    $query = "DELETE FROM company_logo WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $logo_id);
    if (mysqli_stmt_execute($stmt)) {
        $notification = 'Logo berhasil dihapus.';
    } else {
        $notification = 'Gagal menghapus logo.';
    }
}

if (isset($_POST['edit_logo'])) {
    $edit_logo_id = $_POST['edit_logo_id'];

    // Cek apakah ada file yang diunggah
    if (isset($_FILES["logo_perusahaan"])) {
        $file = $_FILES["logo_perusahaan"];
        $file_name = $file["name"];
        $file_tmp = $file["tmp_name"];
        $file_size = $file["size"];

        // Lokasi penyimpanan file
        $uploadDirectory = "uploads/";

        // Batasan ukuran file (2 MB)
        $maxFileSize = 2 * 1024 * 1024; // 2 MB dalam byte

        // Format file yang diizinkan
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        // Mendapatkan ekstensi file
        $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions) && $file_size <= $maxFileSize) {
            // File adalah gambar yang valid
            $targetFile = $uploadDirectory . $file_name;

            if (move_uploaded_file($file_tmp, $targetFile)) {
                // File telah diunggah dengan sukses, simpan nama file dalam database
                $logo_perusahaan = $targetFile;

                $query = "UPDATE company_logo SET logo_perusahaan=? WHERE id=?";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, 'si', $logo_perusahaan, $edit_logo_id);
                if (mysqli_stmt_execute($stmt)) {
                    $notification = 'Logo berhasil diedit.';
                } else {
                    $notification = 'Gagal mengedit logo.';
                }
            } else {
                $notification = 'Gagal mengunggah file logo.';
            }
        } else {
            $notification = 'File logo tidak valid atau terlalu besar.';
        }
    }
}

if (isset($_GET['edit_logo'])) {
    $logo_id = $_GET['edit_logo'];
    $query = "SELECT * FROM company_logo WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $logo_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $logo = mysqli_fetch_assoc($result);
    $editMode = true;
}

$logos = getCompanyLogos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Logo</title>
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

        input[type="file"] {
            width: 100%;
            padding: 8px;
            /* Mengurangi ukuran padding */
            margin-bottom: 8px;
            /* Mengurangi margin-bottom */
            border: 1px solid rgba(0, 0, 0, 0.0);
            /* Warna border transparan */
            border-radius: 3px;
            /* Membuat border lebih presisi */
            font-size: 14px;
            /* Mengurangi ukuran font */
            background: rgba(0, 0, 0, 0.0);
            /* Warna latar belakang transparan */
            color: #fff;
        }

        button[type="submit"] {
            background-color: #5f5380;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            /* Mengurangi ukuran font */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: none;
            /* Warna background hover yang lebih terang */
        }

        /* Menampilkan daftar logo perusahaan */
        .logo-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .logo-item {
            background-color: none;
            /* Warna latar belakang dengan transparansi */
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            text-align: center;
            padding: 10px;
            margin: 10px;
        }

        .logo-item img {
            max-width: 150px;
            height: auto;
        }

        .logo-item a {
            display: block;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .logo-item a:hover {
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

        /* Styling untuk tampilan gambar */
        .logo-preview img {
            max-width: 300px;
            height: auto;
            margin-top: 10px;
        }

        .popup-notification {
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
        <h1>Kelola Logo</h1>

        <!-- Form untuk menambah atau mengedit logo perusahaan -->
        <form method="POST" action="kelola_logo.php" enctype="multipart/form-data">
            <input type="hidden" name="company_id" value="1"> <!-- Ganti dengan ID perusahaan yang sesuai -->
            <?php if ($editMode) : ?>
                <input type="hidden" name="edit_logo_id" value="<?php echo $logo['id']; ?>">
                <div class="logo-preview">
                    <img src="<?php echo $logo['logo_perusahaan']; ?>" alt="Logo Perusahaan">
                </div>

            <?php endif; ?>
            <input type="file" name="logo_perusahaan" required>
            <?php if ($editMode) : ?>
                <button type="submit" name="edit_logo">Edit Logo</button>
                <button type="button" onclick="batalEdit()">Batal</button>
            <?php else : ?>
                <button type="submit" name="tambah_logo">Tambah Logo</button>

            <?php endif; ?>

        </form>

        <!-- Menampilkan daftar logo perusahaan -->
        <div class="logo-list">
            <?php while ($logo = mysqli_fetch_assoc($logos)) : ?>
                <div class="logo-item">
                    <img src="<?php echo $logo['logo_perusahaan']; ?>" alt="Logo Perusahaan">
                    <a href="kelola_logo.php?edit_logo=<?php echo $logo['id']; ?>">Edit</a>
                    <a href="kelola_logo.php?hapus_logo=<?php echo $logo['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus logo ini?')">Hapus</a>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Tombol untuk kembali ke halaman lain -->
        <a href="kelola_header.php" class="back-button">Kembali ke Kelola Header</a>

        <!-- Menampilkan notifikasi -->
        <?php if (!empty($notification)) : ?>
            <div class="popup-notification">
                <?php echo $notification; ?>
            </div>
        <?php endif; ?>

        <!-- Tambahkan JavaScript Anda di sini -->
        <script>
            function batalEdit() {
                // Kembalikan ke tampilan awal untuk menambahkan file
                window.location.href = 'kelola_logo.php';
            }
        </script>
    </div>
</body>

</html>
