<?php
require_once 'koneksi.php';

// Function to get company information
function getCompanyInfo()
{
    global $koneksi;
    $query = "SELECT * FROM company";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

function createCompanyInfo($nama_perusahaan, $slogan_perusahaan, $alamat, $toggle_button_status)
{
    global $koneksi;
    $query = "INSERT INTO company (nama_perusahaan, slogan_perusahaan, alamat, toggle_button_status) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'sssi', $nama_perusahaan, $slogan_perusahaan, $alamat, $toggle_button_status);
    mysqli_stmt_execute($stmt);
}

function updateCompanyInfo($id, $nama_perusahaan, $slogan_perusahaan, $alamat, $toggle_button_status)
{
    global $koneksi;
    $query = "UPDATE company SET nama_perusahaan=?, slogan_perusahaan=?, alamat=?, toggle_button_status=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'sssii', $nama_perusahaan, $slogan_perusahaan, $alamat, $toggle_button_status, $id);
    mysqli_stmt_execute($stmt);
}

// Handling form submissions
if (isset($_POST['submit'])) {
    if (isset($_POST['company_id'])) {
        // Update company information
        $id = $_POST['company_id'];
        $nama_perusahaan = mysqli_real_escape_string($koneksi, $_POST['nama_perusahaan']);
        $slogan_perusahaan = mysqli_real_escape_string($koneksi, $_POST['slogan_perusahaan']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $toggle_button_status = isset($_POST['toggle_button_status']) ? 1 : 0;
        updateCompanyInfo($id, $nama_perusahaan, $slogan_perusahaan, $alamat, $toggle_button_status);
    } else {
        // Create new company information
        $nama_perusahaan = mysqli_real_escape_string($koneksi, $_POST['nama_perusahaan']);
        $slogan_perusahaan = mysqli_real_escape_string($koneksi, $_POST['slogan_perusahaan']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $toggle_button_status = isset($_POST['toggle_button_status']) ? 1 : 0;
        createCompanyInfo($nama_perusahaan, $slogan_perusahaan, $alamat, $toggle_button_status);
    }
}

// Handle delete
if (isset($_GET['delete_company'])) {
    $id = $_GET['delete_company'];
    $query = "DELETE FROM company WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

// Function to get company information by ID
function getCompanyInfoById($id)
{
    global $koneksi;
    $query = "SELECT * FROM company WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Initialize variables
$edit_id = "";
$edit_nama_perusahaan = "";
$edit_slogan_perusahaan = "";
$edit_alamat = "";
$edit_toggle_button_status = 0;

// Check if editing
if (isset($_GET['edit_company'])) {
    $edit_id = $_GET['edit_company'];
    $companyData = getCompanyInfoById($edit_id);
    if ($companyData) {
        $edit_nama_perusahaan = $companyData['nama_perusahaan'];
        $edit_slogan_perusahaan = $companyData['slogan_perusahaan'];
        $edit_alamat = $companyData['alamat'];
        $edit_toggle_button_status = $companyData['toggle_button_status'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Perusahaan</title>
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

        /* Gaya untuk elemen form */
        form {
            text-align: left;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            /* Warna latar belakang dengan transparansi */
            padding: 15px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }

        input[type="text"],
        input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 3px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Gaya untuk tombol "Submit" */
        input[type="submit"] {
            background-color: #eb4034;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #c72b1e;
        }

        /* Gaya untuk tabel data */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid rgba(235, 64, 52, 0.9);
            /* Sesuaikan dengan warna dominan */
            color: #fff;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: rgba(235, 64, 52, 0.9);
            /* Sesuaikan dengan warna dominan */
        }

        /* Gaya untuk tautan */
        a {
            color: #fff;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }

        a:hover {
            color: #c72b1e;
        }
    </style>
</head>

<body>
    <h2>Tambah/Edit Informasi Perusahaan</h2>
    <form action="kelola_company.php" method="post">
        <input type="hidden" name="company_id" value="<?php echo $edit_id; ?>">
        <label for="nama_perusahaan">Nama Perusahaan:</label>
        <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo $edit_nama_perusahaan; ?>" required><br>
        <label for="slogan_perusahaan">Slogan Perusahaan:</label>
        <input type="text" name="slogan_perusahaan" id="slogan_perusahaan" value="<?php echo $edit_slogan_perusahaan; ?>" required><br>
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" value="<?php echo $edit_alamat; ?>" maxlength="50"><br>
        <label for="toggle_button_status">Status Toggle Button:</label>
        <input type="checkbox" name="toggle_button_status" id="toggle_button_status" <?php if ($edit_toggle_button_status == 1) echo 'checked'; ?>><br>
        <input type="submit" name="submit" value="<?php echo $edit_id ? 'Update Data' : 'Tambah Data'; ?>">

        <?php if ($edit_id) : ?>
            <!-- Tombol "Batal Edit" hanya ditampilkan jika sedang mengedit -->
            <a href="kelola_company.php">Batal Edit</a>
        <?php endif; ?>
    </form>

    <h2>Data Perusahaan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Perusahaan</th>
                <th>Slogan Perusahaan</th>
                <th>Alamat</th>
                <th>Status Toggle Button</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $companyInfo = getCompanyInfo();
            while ($company = mysqli_fetch_assoc($companyInfo)) {
                echo "<tr>";
                echo "<td>{$company['id']}</td>";
                echo "<td>{$company['nama_perusahaan']}</td>";
                echo "<td>{$company['slogan_perusahaan']}</td>";
                echo "<td>{$company['alamat']}</td>";
                echo "<td>{$company['toggle_button_status']}</td>";
                echo "<td>
                <a href='kelola_company.php?edit_company={$company['id']}'>Edit</a>
                <a href='kelola_company.php?delete_company={$company['id']}' onclick='return confirmDelete();'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- Tombol untuk kembali ke halaman lain -->
    <a href="kelola_header.php">Kembali ke Header</a>
    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus data perusahaan ini?");
        }
    </script>
</body>

</html>