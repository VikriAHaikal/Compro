<?php
require 'koneksi.php';

function tambahAdmin($nama, $email, $username, $password)
{
    global $koneksi;
    $sql = "INSERT INTO users (nama, email, username, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $nama, $email, $username, $password);
    return mysqli_stmt_execute($stmt);
}

function tampilDataAdmin()
{
    global $koneksi;
    $query = "SELECT id, nama, email, username FROM users";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

function ubahAdmin($id, $nama, $email, $username, $password)
{
    global $koneksi;
    $sql = "UPDATE users SET nama=?, email=?, username=?, password=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $email, $username, $password, $id);
    return mysqli_stmt_execute($stmt);
}

function hapusAdmin($id)
{
    global $koneksi;
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    return mysqli_stmt_execute($stmt);
}

$editMode = false;

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (tambahAdmin($nama, $email, $username, $password)) {
        header("Location: kelola_akun.php");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Gagal menambahkan data admin.</div>';
    }
}

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $edit_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $edit_nama = $row['nama'];
        $edit_email = $row['email'];
        $edit_username = $row['username'];
        $edit_password = $row['password'];
        $editMode = true;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo '<script>
        var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
        if(konfirmasi){
            window.location.href = "kelola_akun.php?delete_confirmed=' . $id . '";
        }
    </script>';
}

if (isset($_GET['delete_confirmed'])) {
    $id = $_GET['delete_confirmed'];
    if (hapusAdmin($id)) {
        header("Location: kelola_akun.php");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Gagal menghapus data admin.</div>';
    }
}

if (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (ubahAdmin($edit_id, $nama, $email, $username, $password)) {
        header("Location: kelola_akun.php");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Gagal mengubah data admin.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('bgs.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.0);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin: 50px auto;
            padding: 20px;
            max-width: 800px;
        }

        h2,
        h4 {
            color: #fff;
        }

        .card {
            margin-bottom: 20px;
        }

        .form-label,
        label,
        .text-white {
            color: white;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Tombol Edit */
        .btn-edit {
            background-color: #5f5380;
            border-color: #5f5380;
            color: white;
        }

        .btn-edit:hover {
            background-color: #493d67;
            border-color: #493d67;
        }

        /* Tombol Hapus */
        .btn-hapus {
            background-color: #eb4034;
            border-color: #eb4034;
            color: white;
        }

        .btn-hapus:hover {
            background-color: #c9302c;
            border-color: #c9302c;
        }

        .alert {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-white">Kelola Akun Admin</h2>

        <!-- Tambah/Edit Akun Admin -->
        <h4 class="text-white"><?php echo ($editMode) ? 'Edit Akun Admin' : 'Tambah Akun Admin'; ?></h4>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" value="<?php echo ($editMode) ? $edit_id : ''; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label text-white">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo ($editMode) ? $edit_nama : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-white">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo ($editMode) ? $edit_email : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label text-white">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required value="<?php echo ($editMode) ? $edit_username : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white">Password:</label>
                <input type="password" class="form-control" id="password" name="password" <?php echo ($editMode) ? '' : 'required'; ?>>
            </div>
            <button type="submit" class="btn btn-primary" name="<?php echo ($editMode) ? 'update' : 'submit'; ?>"><?php echo ($editMode) ? 'Update' : 'Simpan'; ?></button>
        </form>

        <!-- Tampilan Data Admin -->
        <?php
        $data = tampilDataAdmin();
        if ($data->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Nama</th>';
            echo '<th scope="col">Email</th>';
            echo '<th scope="col">Username</th>';
            echo '<th scope="col">Aksi</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $data->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nama'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>';
                echo '<a href="?edit=' . $row['id'] . '" class="btn btn-edit">Edit</a>';
                echo '<a href="?delete=' . $row['id'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus akun admin ini?\')" class="btn btn-hapus">Hapus</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="text-white">Tidak ada akun admin.</p>';
        }
        ?>
        
        <!-- Tambahkan tombol untuk kembali ke dashboard admin -->
        <a href="dashboard.php" class="btn btn-secondary mb-3">Kembali ke Dashboard Admin</a>
    </div>

    <!-- JavaScript Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sembunyikan notifikasi setelah 3 detik
        setTimeout(function() {
            document.getElementById("successAlert").style.display = "none";
            document.getElementById("errorAlert").style.display = "none";
        }, 3000);
    </script>
</body>
</html>

