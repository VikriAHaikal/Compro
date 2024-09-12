<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Produk</title>
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
            /* Tambahkan .text-white untuk warna putih */
            color: white;
        }

        .image-container {
            width: 100%;
            height: 200px;
            /* Atur tinggi gambar sesuai dengan kebutuhan Anda */
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background-color: #5f5380;
            border-color: #5f5380;
        }

        .btn-primary:hover {
            background-color: #eb4034;
            border-color: #eb4034;
        }

        .btn-secondary {
            background-color: #444;
            border-color: #444;
        }

        .btn-secondary:hover {
            background-color: #666;
            border-color: #666;
        }

        .alert {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-white">Kelola Produk</h2>

        <?php
        require 'koneksi.php'; // Panggil file koneksi.php

        // Fungsi escape untuk menghindari XSS
        function escape($string)
        {
            global $koneksi;
            return mysqli_real_escape_string($koneksi, $string);
        }

        // Tambah atau edit data produk
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['simpan'])) {
                $nama_produk = escape($_POST['nama_produk']);
                $kategori = escape($_POST['kategori']);
                $gambar_produk = ''; // Inisialisasi
                $penjelasan = escape($_POST['penjelasan']); // Ambil penjelasan dari formulir

                $id = $_POST['id'];
                if ($id === '') {
                    // Insert data baru
                    $sql = "INSERT INTO produk (nama_produk, kategori, gambar_produk, penjelasan) VALUES ('$nama_produk', '$kategori', '$gambar_produk', '$penjelasan')";
                } else {
                    // Update data
                    $sql = "UPDATE produk SET nama_produk='$nama_produk', kategori='$kategori', gambar_produk='$gambar_produk', penjelasan='$penjelasan' WHERE id=$id";
                }

                if ($koneksi->query($sql)) {
                    echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil disimpan.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menyimpan data: ' . $koneksi->error . '</div>';
                }
            }

            // Handle upload gambar produk
            if (isset($_FILES['gambar_produk'])) {
                $id = $_POST['id'];
                $gambar_url = ''; // Inisialisasi

                // Proses unggah gambar
                $gambar = $_FILES['gambar_produk'];
                if ($gambar['error'] === UPLOAD_ERR_OK) {
                    $namaFile = basename($gambar['name']);
                    $targetDir = 'uploads_produk/'; // Ganti dengan direktori tujuan unggahan gambar
                    $targetPath = $targetDir . $namaFile;

                    if (move_uploaded_file($gambar['tmp_name'], $targetPath)) {
                        $gambar_url = $targetPath;

                        // Update URL gambar ke database jika diperlukan
                        if (!empty($id)) {
                            $sql = "UPDATE produk SET gambar_produk='$gambar_url' WHERE id=$id";
                            if (!$koneksi->query($sql)) {
                                echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal mengupdate gambar: ' . $koneksi->error . '</div>';
                            }
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal mengunggah gambar.</div>';
                    }
                }
            }
        }

        // Hapus data produk
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];

            $sql = "DELETE FROM produk WHERE id=$id";
            if ($koneksi->query($sql)) {
                echo '<div class="alert alert-success" role="alert" id="successAlert">Data berhasil dihapus.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert" id="errorAlert">Gagal menghapus data: ' . $koneksi->error . '</div>';
            }
        }
        ?>

        <h4 class="text-white">Tambah/Edit Produk</h4>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="nama_produk" class="form-label text-white">Nama Produk:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label text-white">Kategori:</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="Unit Simpan Pinjam (USP)">Unit Simpan Pinjam (USP)</option>
                    <option value="Unit Ritael">Unit Ritael</option>
                    <option value="Unit Jasa">Unit Jasa</option>
                    <option value="UKM">UKM</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gambar_produk" class="form-label text-white">Gambar Produk:</label>
                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
            </div>

            <div class="mb-3">
                <label for="penjelasan" class="form-label text-white">Penjelasan:</label>
                <textarea class="form-control" id="penjelasan" name="penjelasan" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form> <br>

        <h4 class="text-white">Daftar Produk</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $sql = "SELECT * FROM produk";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col">';
                    echo '<div class="card">';
                    echo '<div class="image-container">'; // Tambahkan kontainer gambar
                    echo '<img src="' . $row['gambar_produk'] . '" class="card-img-top product-image" alt="' . $row['nama_produk'] . '">';
                    echo '</div>'; // Tutup kontainer gambar
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title text-dark">' . $row['nama_produk'] . '</h5>';
                    echo '<p class="card-text"><span class="text-muted">Kategori: ' . $row['kategori'] . '</span></p>';
                    echo '<div class="d-flex justify-content-between align-items-center">';
                    echo '<a href="kelola_produk.php?hapus=' . $row['id'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus produk ini?\')" class="btn btn-danger">Hapus</a>';
                    echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal' . $row['id'] . '">Edit</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Modal Edit
                    echo '<div class="modal fade" id="editModal' . $row['id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row['id'] . '" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="editModalLabel' . $row['id'] . '">Edit Produk</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<form method="post" action="" enctype="multipart/form-data">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<div class="mb-3">';
                    echo '<label for="nama_produk" class="form-label text-white">Nama Produk:</label>';
                    echo '<input type="text" class="form-control" id="nama_produk" name="nama_produk" value="' . $row['nama_produk'] . '" required>';
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label for="kategori" class="form-label text-white">Kategori:</label>';
                    echo '<select class="form-select" id="kategori" name="kategori" required>';
                    echo '<option value="Unit Simpan Pinjam (USP)" ' . ($row['kategori'] === 'Unit Simpan Pinjam (USP)' ? 'selected' : '') . '>Unit Simpan Pinjam (USP)</option>';
                    echo '<option value="Unit Ritael" ' . ($row['kategori'] === 'Unit Ritael' ? 'selected' : '') . '>Unit Ritael</option>';
                    echo '<option value="Unit Jasa" ' . ($row['kategori'] === 'Unit Jasa' ? 'selected' : '') . '>Unit Jasa</option>';
                    echo '<option value="UKM" ' . ($row['kategori'] === 'UKM' ? 'selected' : '') . '>UKM</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label for="gambar_produk" class="form-label text-white">Gambar Produk:</label>';
                    echo '<input type="file" class="form-control" id="gambar_produk" name="gambar_produk">';
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label for="penjelasan" class="form-label text-white">Penjelasan:</label>';
                    echo '<textarea class="form-control" id="penjelasan" name="penjelasan" rows="3">' . $row['penjelasan'] . '</textarea>';
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
                echo '<p class="text-white">Tidak ada produk.</p>';
            }
            ?>
        </div>

        <!-- Tambahkan tombol untuk kembali ke dashboard admin -->
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