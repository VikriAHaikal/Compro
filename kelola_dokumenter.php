<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Dokumenter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Tambahkan style tambahan sesuai keinginan */
        .card {
            margin-bottom: 20px;
        }

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

        /* Tambahkan style tambahan sesuai keinginan */
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
        <h2 class="text-white">Kelola Dokumenter</h2>

        <?php
        require 'koneksi.php'; // Panggil file koneksi.php

        // Fungsi escape untuk menghindari XSS
        function escape($string)
        {
            global $koneksi;
            return mysqli_real_escape_string($koneksi, $string);
        }

        // Tambah atau edit data dokumenter
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['simpan'])) {
                $namaKonten = $_FILES['konten']['name'];
                $namaLagu = $_FILES['lagu']['name'];
                $konten_url = ''; // Inisialisasi
                $lagu_url = ''; // Inisialisasi

                // Proses unggah file konten
                $konten = $_FILES['konten'];
                if ($konten['error'] === UPLOAD_ERR_OK) {
                    $namaKontenFile = basename($konten['name']);
                    $kontenDir = 'uploads/'; // Ganti dengan direktori tujuan unggahan konten
                    $kontenPath = $kontenDir . $namaKontenFile;

                    if (move_uploaded_file($konten['tmp_name'], $kontenPath)) {
                        $konten_url = $kontenPath;
                    }
                }

                // Proses unggah file lagu
                $lagu = $_FILES['lagu'];
                if ($lagu['error'] === UPLOAD_ERR_OK) {
                    $namaLaguFile = basename($lagu['name']);
                    $laguDir = 'uploads/'; // Ganti dengan direktori tujuan unggahan lagu
                    $laguPath = $laguDir . $namaLaguFile;

                    if (move_uploaded_file($lagu['tmp_name'], $laguPath)) {
                        $lagu_url = $laguPath;
                    }
                }

                $id = $_POST['id'];
                if ($id === '') {
                    // Insert data baru
                    $sql = "INSERT INTO dokumenter (nama_konten, nama_lagu) VALUES ('$konten_url', '$lagu_url')";
                } else {
                    // Update data
                    $sql = "UPDATE dokumenter SET nama_konten='$konten_url', nama_lagu='$lagu_url' WHERE id=$id";
                }

                if ($koneksi->query($sql)) {
                    echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil disimpan.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menyimpan data: ' . $koneksi->error . '</div>';
                }
            }
        }

        // Hapus data dokumenter
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            $sql = "SELECT nama_konten, nama_lagu FROM dokumenter WHERE id=$id";
            $result = $koneksi->query($sql);
            $dataDokumenter = $result->fetch_assoc();

            if (file_exists($dataDokumenter['nama_konten'])) {
                unlink($dataDokumenter['nama_konten']);
            }

            if (file_exists($dataDokumenter['nama_lagu'])) {
                unlink($dataDokumenter['nama_lagu']);
            }

            $sql = "DELETE FROM dokumenter WHERE id=$id";
            if ($koneksi->query($sql)) {
                echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil dihapus.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menghapus data: ' . $koneksi->error . '</div>';
            }
        }
        ?>

        <h4 class="text-white">Tambah/Edit Dokumenter</h4>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="konten" class="form-label text-white">Nama Konten (Gambar/Video):</label>
                <input type="file" class="form-control" id="konten" name="konten" required>
            </div>
            <div class="mb-3">
                <label for="lagu" class="form-label text-white">Nama Lagu:</label>
                <input type="file" class="form-control" id="lagu" name="lagu" required>
            </div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form>

        <?php
        $sql = "SELECT * FROM start_page";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="row mb-4">';
                echo '<div class="col-md-6">';
                echo '<h4 class="text-white">Konten</h4>';
                echo '<video width="100%" height="auto" controls>';
                echo '<source src="' . $row['nama_konten'] . '" type="video/mp4">';
                echo 'Your browser does not support the video tag.';
                echo '</video>';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<h4 class="text-white">Lagu</h4>';
                echo '<audio controls>';
                echo '<source src="' . $row['nama_lagu'] . '" type="audio/mpeg">';
                echo 'Your browser does not support the audio element.';
                echo '</audio>';
                echo '<a href="kelola_dokumenter.php?hapus=' . $row['id'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" class="btn btn-hapus">Hapus</a>';
                echo '<button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editModal' . $row['id'] . '">Edit</button>';
                echo '</div>';
                echo '</div>';

                // Modal Edit
                echo '<div class="modal fade" id="editModal' . $row['id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row['id'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="editModalLabel' . $row['id'] . '">Edit Dokumenter</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<form method="post" action="" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<div class="mb-3">';
                echo '<label for="edit_konten' . $row['id'] . '" class="form-label text-white">Nama Konten (Gambar/Video):</label>';
                echo '<input type="file" class="form-control" id="edit_konten' . $row['id'] . '" name="konten" required>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="edit_lagu' . $row['id'] . '" class="form-label text-white">Nama Lagu:</label>';
                echo '<input type="file" class="form-control" id="edit_lagu' . $row['id'] . '" name="lagu" required>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>';
                echo '</form>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-white">Tidak ada data dokumenter.</p>';
        }
        ?>

        <!-- Tambahkan tombol untuk kembali ke halaman admin yang sesuai -->
        <a href="kelola_body.php" class="btn btn-secondary mb-3">Kembali ke Kelola Body</a>
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
