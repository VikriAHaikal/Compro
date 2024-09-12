<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Penghargaan</title>
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
        <h2 class="text-white">Kelola Penghargaan</h2>

        <?php
        require 'koneksi.php'; // Panggil file koneksi.php

        // Fungsi escape untuk menghindari XSS
        function escape($string)
        {
            global $koneksi;
            return mysqli_real_escape_string($koneksi, $string);
        }

        // Tambah atau edit data penghargaan
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['simpan'])) {
                $tingkat = escape($_POST['tingkat']);
                $keterangan = escape($_POST['keterangan']);
                $tahun = escape($_POST['tahun']);
                $gambar_url = ''; // Inisialisasi

                // Proses unggah gambar
                $gambar = $_FILES['gambar'];
                if ($gambar['error'] === UPLOAD_ERR_OK) {
                    $namaFile = basename($gambar['name']);
                    $targetDir = 'uploads/'; // Ganti dengan direktori tujuan unggahan gambar
                    $targetPath = $targetDir . $namaFile;

                    if (move_uploaded_file($gambar['tmp_name'], $targetPath)) {
                        $gambar_url = $targetPath;
                    }
                }

                $id = $_POST['id'];
                if ($id === '') {
                    // Insert data baru
                    $sql = "INSERT INTO penghargaan (tingkat, keterangan, tahun, gambar) VALUES ('$tingkat', '$keterangan', '$tahun', '$gambar_url')";
                } else {
                    // Update data
                    $sql = "UPDATE penghargaan SET tingkat='$tingkat', keterangan='$keterangan', tahun='$tahun', gambar='$gambar_url' WHERE id=$id";
                }

                if ($koneksi->query($sql)) {
                    echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil disimpan.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menyimpan data: ' . $koneksi->error . '</div>';
                }
            }
        }

        // Hapus data penghargaan
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            $sql = "SELECT gambar FROM penghargaan WHERE id=$id";
            $result = $koneksi->query($sql);
            $dataPenghargaan = $result->fetch_assoc();

            if (file_exists($dataPenghargaan['gambar'])) {
                unlink($dataPenghargaan['gambar']);
            }

            $sql = "DELETE FROM penghargaan WHERE id=$id";
            if ($koneksi->query($sql)) {
                echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil dihapus.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menghapus data: ' . $koneksi->error . '</div>';
            }
        }
        ?>

        <h4 class="text-white">Tambah/Edit Penghargaan</h4>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="tingkat" class="form-label text-white">Tingkat:</label>
                <select class="form-select" id="tingkat" name="tingkat" required>
                    <option value="Kota">Kota</option>
                    <option value="Kabupaten">Kabupaten</option>
                    <option value="Provinsi">Provinsi</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label text-white">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label text-white">Tahun:</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label text-white">Gambar:</label>
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form>

        <?php
        $sql = "SELECT * FROM penghargaan";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="row mb-4">';
                echo '<div class="col-md-6">';
                echo '<img src="' . $row['gambar'] . '" class="img-fluid" alt="' . $row['tingkat'] . '">';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<h4 class="text-white">' . $row['tingkat'] . ' - ' . $row['tahun'] . '</h4>';
                echo '<p class="text-white"><strong>Keterangan:</strong> ' . $row['keterangan'] . '</p>';
                echo '<a href="kelola_penghargaan.php?hapus=' . $row['id'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus penghargaan ini?\')" class="btn btn-hapus">Hapus</a>';
                echo '<button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editModal' . $row['id'] . '">Edit</button>';

                echo '</div>';
                echo '</div>';

                // Modal Edit
                echo '<div class="modal fade" id="editModal' . $row['id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row['id'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="editModalLabel' . $row['id'] . '">Edit Penghargaan</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<form method="post" action="" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<div class="mb-3">';
                echo '<label for="edit_tingkat' . $row['id'] . '" class="form-label text-white">Tingkat:</label>';
                echo '<select class="form-select" id="edit_tingkat' . $row['id'] . '" name="tingkat" required>';
                echo '<option value="Kota" ' . ($row['tingkat'] == 'Kota' ? 'selected' : '') . '>Kota</option>';
                echo '<option value="Kabupaten" ' . ($row['tingkat'] == 'Kabupaten' ? 'selected' : '') . '>Kabupaten</option>';
                echo '<option value="Provinsi" ' . ($row['tingkat'] == 'Provinsi' ? 'selected' : '') . '>Provinsi</option>';
                echo '<option value="Nasional" ' . ($row['tingkat'] == 'Nasional' ? 'selected' : '') . '>Nasional</option>';
                echo '<option value="Internasional" ' . ($row['tingkat'] == 'Internasional' ? 'selected' : '') . '>Internasional</option>';
                echo '</select>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="edit_keterangan' . $row['id'] . '" class="form-label text-white">Keterangan:</label>';
                echo '<textarea class="form-control" id="edit_keterangan' . $row['id'] . '" name="keterangan" rows="4" required>' . $row['keterangan'] . '</textarea>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="edit_tahun' . $row['id'] . '" class="form-label text-white">Tahun:</label>';
                echo '<input type="number" class="form-control" id="edit_tahun' . $row['id'] . '" name="tahun" value="' . $row['tahun'] . '" required>';
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
            echo '<p class="text-white">Tidak ada penghargaan.</p>';
        }
        ?>

        <!-- Tambahkan tombol untuk kembali ke dashboard admin -->
        <a href="kelola_body.php" class="btn btn-secondary mb-3">Kembali ke Kelola Body</a>
    </div>

    <!-- JavaScript Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sembunyikan notifikasi setelah 3 detik
        function deletePenghargaan(id) {
            if (confirm('Apakah Anda yakin ingin menghapus penghargaan ini?')) {
                // Kirim permintaan penghapusan ke server menggunakan AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'kelola_penghargaan.php?hapus=' + id, true);

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Respon dari server berhasil diterima
                        var response = xhr.responseText;
                        if (response === 'success') {
                            // Penghapusan berhasil, perbarui tampilan
                            location.reload();
                        } else {
                            // Terjadi kesalahan
                            alert('Gagal menghapus data.');
                        }
                    } else {
                        // Terjadi kesalahan dalam mengirim permintaan
                        alert('Terjadi kesalahan dalam mengirim permintaan.');
                    }
                };

                xhr.send();
            }
        }
        
        setTimeout(function() {
            document.getElementById("successAlert").style.display = "none";
            document.getElementById("errorAlert").style.display = "none";
        }, 3000);
    </script>
</body>

</html>
