<?php
require_once 'koneksi.php';

// Fungsi-fungsi untuk mengakses database
function getCompanySocialIcons()
{
    global $koneksi;
    $query = "SELECT * FROM company_social_icons";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

function getCompanySocialIconById($id)
{
    global $koneksi;
    $query = "SELECT * FROM company_social_icons WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function createCompanySocialIcon($company_id, $icon_name, $icon_url)
{
    global $koneksi;
    $query = "INSERT INTO company_social_icons (company_id, icon_name, icon_url) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'iss', $company_id, $icon_name, $icon_url);
    mysqli_stmt_execute($stmt);
}

function updateCompanySocialIcon($id, $icon_name, $icon_url)
{
    global $koneksi;
    $query = "UPDATE company_social_icons SET icon_name=?, icon_url=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'ssi', $icon_name, $icon_url, $id);
    mysqli_stmt_execute($stmt);
}

function deleteCompanySocialIcon($id)
{
    global $koneksi;
    $query = "DELETE FROM company_social_icons WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

$edit_icon_data = null;

// Tangani permintaan POST
if (isset($_POST['tambah_icon'])) {
    $company_id = $_POST['company_id'];
    $icon_name = $_FILES['icon_name']['name']; // Menggunakan nama file yang diunggah
    $icon_url = $_POST['icon_url'];
    $file_tmp = $_FILES['icon_name']['tmp_name'];

    // Direktori tempat menyimpan file yang diunggah
    $upload_dir = 'uploads/';

    // Pindahkan file yang diunggah ke direktori uploads dengan nama yang sama
    move_uploaded_file($file_tmp, $upload_dir . $icon_name);

    // Simpan informasi ikon media sosial ke dalam database
    createCompanySocialIcon($company_id, $icon_name, $icon_url);

    // Alihkan kembali ke halaman kelola_sosmed.php
    header("Location: kelola_sosmed.php");
}

if (isset($_POST['update_icon'])) {
    $icon_id = $_POST['icon_id'];
    $icon_name = $_FILES['icon_name']['name']; // Menggunakan nama file yang diunggah
    $icon_url = $_POST['icon_url'];

    // Direktori tempat menyimpan file yang diunggah
    $upload_dir = 'uploads/';

    // Pindahkan file yang diunggah ke direktori uploads dengan nama yang sama
    move_uploaded_file($_FILES['icon_name']['tmp_name'], $upload_dir . $icon_name);

    // Update ikon media sosial di database
    updateCompanySocialIcon($icon_id, $icon_name, $icon_url);

    // Alihkan kembali ke halaman kelola_sosmed.php
    header("Location: kelola_sosmed.php");
}

if (isset($_GET['delete_icon'])) {
    $icon_id = $_GET['delete_icon'];

    // Hapus ikon media sosial dari database
    deleteCompanySocialIcon($icon_id);

    // Alihkan kembali ke halaman kelola_sosmed.php
    header("Location: kelola_sosmed.php");
}

// Jika ada permintaan edit, dapatkan data ikon yang akan diedit
if (isset($_GET['edit_icon'])) {
    $edit_icon_id = $_GET['edit_icon'];
    $edit_icon_data = getCompanySocialIconById($edit_icon_id);
}

// Mendapatkan data ikon media sosial perusahaan
$icons = getCompanySocialIcons();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Company Social Icons</title>
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
            background-color: rgba(0, 0, 0, 0.0); /* Warna latar belakang dengan transparansi */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin: 50px auto; /* Margin atas dan bawah dikurangi */
            padding: 20px;
            max-width: 600px; /* Lebar maksimum ditingkatkan */
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
            padding: 8px; /* Mengurangi ukuran padding */
            margin-bottom: 8px; /* Mengurangi margin-bottom */
            border: 1px solid rgba(0, 0, 0, 0.0); /* Warna border transparan */
            border-radius: 3px; /* Membuat border lebih presisi */
            font-size: 14px; /* Mengurangi ukuran font */
            background: rgba(0, 0, 0, 0.0); /* Warna latar belakang transparan */
            color: #fff;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px; /* Mengurangi ukuran padding */
            margin-bottom: 8px; /* Mengurangi margin-bottom */
            border: 1px solid rgba(0, 0, 0, 0.3); /* Warna border transparan */
            border-radius: 3px; /* Membuat border lebih presisi */
            font-size: 14px; /* Mengurangi ukuran font */
            background: rgba(0, 0, 0, 0.0); /* Warna latar belakang transparan */
            color: #fff;
        }

        button[type="submit"] {
            background-color: #5f5380;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px; /* Mengurangi ukuran font */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: none; /* Warna background hover yang lebih terang */
        }

        /* Menampilkan daftar ikon media sosial perusahaan */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: none; /* Warna latar belakang dengan transparansi */
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            text-align: center;
            padding: 10px;
            margin: 10px 0;
        }

        li img {
            max-width: 50px;
            height: auto;
        }

        li p {
            flex: 1;
            margin: 0 10px;
            color: #fff;
        }

        li a {
            background-color: none; /* Warna latar belakang dengan transparansi */
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        li a:hover {
            background-color: #eb4034; /* Warna background hover yang lebih terang */
        }

        /* Tombol untuk kembali ke header.php */
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
            background-color: #eb4034; /* Warna background hover yang lebih terang */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Kelola Company Social Icons</h1>

        <!-- Form untuk mengunggah file dari perangkat -->
        <form method="POST" action="kelola_sosmed.php" enctype="multipart/form-data">
            <input type="hidden" name="company_id" value="1"> <!-- Ganti dengan ID perusahaan yang sesuai -->
            <?php if ($edit_icon_data) : ?>
                <input type="hidden" name="icon_id" value="<?php echo $edit_icon_data['id']; ?>">
            <?php endif; ?>
            <label for="icon_name">Pilih File:</label>
            <input type="file" name="icon_name" id="icon_name" <?php if (!$edit_icon_data) echo 'required'; ?>>
            <input type="text" name="icon_url" placeholder="URL Ikon" required <?php if ($edit_icon_data) echo 'value="' . $edit_icon_data['icon_url'] . '"'; ?>>
            <button type="submit" name="<?php echo $edit_icon_data ? 'update_icon' : 'tambah_icon'; ?>">
                <?php echo $edit_icon_data ? 'Update' : 'Create'; ?>
            </button>
            <?php if ($edit_icon_data) : ?>
                <a href="kelola_sosmed.php">Batal Edit</a>
            <?php endif; ?>
        </form>

        <!-- Menampilkan daftar ikon media sosial perusahaan -->
        <ul>
            <?php while ($icon = mysqli_fetch_assoc($icons)) : ?>
                <li>
                    <img src="uploads/<?php echo $icon['icon_name']; ?>" alt="<?php echo $icon['icon_name']; ?>">
                    <p><?php echo $icon['icon_url']; ?></p>
                    <a href="<?php echo $icon['icon_url']; ?>" target="_blank">Kunjungi</a>
                    <a href="kelola_sosmed.php?edit_icon=<?php echo $icon['id']; ?>">Edit</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $icon['id']; ?>)">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>

        <!-- Tombol untuk kembali ke header.php -->
        <a href="kelola_header.php" class="back-button">Kembali ke Header</a>

        <!-- JavaScript untuk konfirmasi delete -->
        <script>
            function confirmDelete(iconId) {
                var confirmDelete = confirm("Apakah Anda yakin ingin menghapus ikon ini?");
                if (confirmDelete) {
                    window.location.href = "kelola_sosmed.php?delete_icon=" + iconId;
                }
            }
        </script>
    </div>
</body>

</html>
