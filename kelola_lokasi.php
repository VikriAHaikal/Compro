<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Lokasi</title>
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

        /* Tombol Lihat Lokasi */
        .btn-lihat-lokasi {
            color: white;
        }

        .alert {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-white">Kelola Lokasi</h2>

        <?php
        require 'koneksi.php'; // Panggil file koneksi.php

        // Fungsi escape untuk menghindari XSS
        function escape($string)
        {
            global $koneksi;
            return mysqli_real_escape_string($koneksi, $string);
        }

        // Tambah atau edit data lokasi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['simpan'])) {
                $nama_perusahaan = escape($_POST['nama_perusahaan']);
                $deskripsi = escape($_POST['deskripsi']);
                $link_gmaps = escape($_POST['link_gmaps']);
                $url_gambar = ''; // Inisialisasi

                $id = $_POST['id'];
                if ($id === '') {
                    // Insert data baru
                    $sql = "INSERT INTO lokasi (nama_perusahaan, deskripsi, link_gmaps, url_gambar) VALUES ('$nama_perusahaan', '$deskripsi', '$link_gmaps', '$url_gambar')";
                    if ($koneksi->query($sql)) {
                        // Ambil ID terakhir yang ditambahkan
                        $last_id = $koneksi->insert_id;

                        // Handle upload gambar
                        if (isset($_FILES['gambar'])) {
                            $gambar_url = ''; // Inisialisasi

                            // Proses unggah gambar
                            $gambar = $_FILES['gambar'];
                            if ($gambar['error'] === UPLOAD_ERR_OK) {
                                $namaFile = basename($gambar['name']);
                                $targetDir = 'uploads/'; // Ganti dengan direktori tujuan unggahan gambar
                                $targetPath = $targetDir . $namaFile;

                                if (move_uploaded_file($gambar['tmp_name'], $targetPath)) {
                                    $gambar_url = $targetPath;

                                    // Update URL gambar ke database
                                    $sql = "UPDATE lokasi SET url_gambar='$gambar_url' WHERE id=$last_id";
                                    if (!$koneksi->query($sql)) {
                                        echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal mengupdate gambar: ' . $koneksi->error . '</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal mengunggah gambar.</div>';
                                }
                            }
                        }

                        echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil disimpan.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menyimpan data: ' . $koneksi->error . '</div>';
                    }
                } else {
                    // Update data
                    $sql = "UPDATE lokasi SET nama_perusahaan='$nama_perusahaan', deskripsi='$deskripsi', link_gmaps='$link_gmaps' WHERE id=$id";
                    if ($koneksi->query($sql)) {
                        echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil disimpan.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menyimpan data: ' . $koneksi->error . '</div>';
                    }

                    // Handle upload gambar jika ada perubahan gambar
                    if (isset($_FILES['gambar'])) {
                        $gambar_url = ''; // Inisialisasi

                        // Proses unggah gambar
                        $gambar = $_FILES['gambar'];
                        if ($gambar['error'] === UPLOAD_ERR_OK) {
                            $namaFile = basename($gambar['name']);
                            $targetDir = 'uploads/'; // Ganti dengan direktori tujuan unggahan gambar
                            $targetPath = $targetDir . $namaFile;

                            if (move_uploaded_file($gambar['tmp_name'], $targetPath)) {
                                $gambar_url = $targetPath;

                                // Update URL gambar ke database jika diperlukan
                                $sql = "UPDATE lokasi SET url_gambar='$gambar_url' WHERE id=$id";
                                if (!$koneksi->query($sql)) {
                                    echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal mengupdate gambar: ' . $koneksi->error . '</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal mengunggah gambar.</div>';
                            }
                        }
                    }
                }
            }
        }

        // Hapus data lokasi
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];

            $sql = "DELETE FROM lokasi WHERE id=$id";
            if ($koneksi->query($sql)) {
                echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil dihapus.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menghapus data: ' . $koneksi->error . '</div>';
            }
        }
        ?>

        <h4 class="text-white">Tambah/Edit Lokasi</h4>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="nama_perusahaan" class="form-label text-white">Nama Perusahaan:</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label text-white">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="link_gmaps" class="form-label text-white">Link Google Maps:</label>
                <input type="text" class="form-control" id="link_gmaps" name="link_gmaps" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label text-white">Gambar:</label>
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form> <br>
        <?php
        $sql = "SELECT * FROM lokasi";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="row mb-4">';
                echo '<div class="col-md-6">';
                echo '<img src="' . $row['url_gambar'] . '" class="img-fluid" alt="' . $row['nama_perusahaan'] . '">';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<h4 class="text-white">' . $row['nama_perusahaan'] . '</h4>';
                echo '<p class="text-white"><strong>Deskripsi:</strong> ' . $row['deskripsi'] . '</p>';
                echo '<a href="' . $row['link_gmaps'] . '" target="_blank" class="btn btn-lihat-lokasi">Lihat Lokasi</a>';
                echo '<a href="kelola_lokasi.php?hapus=' . $row['id'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus lokasi ini?\')" class="btn btn-hapus">Hapus</a>';
                echo '<button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editModal' . $row['id'] . '">Edit</button>';

                echo '</div>';
                echo '</div>';

                // Modal Edit
                echo '<div class="modal fade" id="editModal' . $row['id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row['id'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="editModalLabel' . $row['id'] . '">Edit Lokasi</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<form method="post" action="" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<div class="mb-3">';
                echo '<label for="edit_nama_perusahaan' . $row['id'] . '" class="form-label text-white">Nama Perusahaan:</label>';
                echo '<input type="text" class="form-control" id="edit_nama_perusahaan' . $row['id'] . '" name="nama_perusahaan" value="' . $row['nama_perusahaan'] . '" required>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="edit_deskripsi' . $row['id'] . '" class="form-label text-white">Deskripsi:</label>';
                echo '<textarea class="form-control" id="edit_deskripsi' . $row['id'] . '" name="deskripsi" rows="4" required>' . $row['deskripsi'] . '</textarea>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="edit_link_gmaps' . $row['id'] . '" class="form-label text-white">Link Google Maps:</label>';
                echo '<input type="text" class="form-control" id="edit_link_gmaps' . $row['id'] . '" name="link_gmaps" value="' . $row['link_gmaps'] . '" required>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="edit_gambar' . $row['id'] . '" class="form-label text-white">Gambar:</label>';
                echo '<input type="file" class="form-control" id="edit_gambar' . $row['id'] . '" name="gambar">';
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
            echo '<p class="text-white">Tidak ada lokasi.</p>';
        }
        ?>
        <!-- Tambahkan tombol untuk kembali ke dashboard admin -->
        <a href="kelola_body.php" class="btn btn-secondary mb-3">Kembali ke Kelola Lokasi</a>
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
