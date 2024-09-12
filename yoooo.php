<?php
// Mengimpor koneksi.php
require_once 'koneksi.php';

// Fungsi-fungsi untuk mengakses database
function getAllMenu()
{
    global $koneksi;
    $query = "SELECT * FROM menu";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

function tampilDataSubmenu($menu_id)
{
    global $koneksi;
    $query = "SELECT id, nama_submenu FROM submenu WHERE menu_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $menu_id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];

    // Debug: Cetak menu_id
    echo "Menu ID: " . $menu_id;

    if (isset($_GET['submenu_id'])) {
        $submenu_id = $_GET['submenu_id'];

        // Debug: Cetak submenu_id
        echo " Submenu ID: " . $submenu_id;

        // Pengalihan berdasarkan menu_id dan submenu_id
        if ($menu_id == 1) {
            if ($submenu_id == 1) {
                header('Location: sejarah.php');
                exit;
            } elseif ($submenu_id == 2) {
                header('Location: visi_misi.php');
                exit;
            } elseif ($submenu_id == 25) {
                header('Location: struktur.php');
                exit;
            } elseif ($submenu_id == 54) {
                header('Location: penghargaan.php');
                exit;
            }
        }

        if ($menu_id == 2) {
            if ($submenu_id == 5) {
                header('Location: berita_pendidikan.php');
                exit;
            } elseif ($submenu_id == 6) {
                header('Location: berita_sosial.php');
                exit;
            } elseif ($submenu_id == 7) {
                header('Location: berita_teknologi.php');
                exit;
            } elseif ($submenu_id == 55) {
                header('Location: berita_lainnya.php');
                exit;
            }
        }

        if ($menu_id == 3) {
            if ($submenu_id == 8) {
                header('Location: unit_retail.php');
                exit;
            } elseif ($submenu_id == 9) {
                header('Location: unit_simpan.php');
                exit;
            } elseif ($submenu_id == 10) {
                header('Location: unit_jasa.php');
                exit;
            } elseif ($submenu_id == 11) {
                header('Location: umkm.php');
                exit;
            }
        }

        if ($menu_id == 4) {
            if ($submenu_id == 12) {
                header('Location: adismart1.php');
                exit;
            } elseif ($submenu_id == 13) {
                header('Location: adismart2.php');
                exit;
            } elseif ($submenu_id == 14) {
                header('Location: adismart_ciruas.php');
                exit;
            } elseif ($submenu_id == 15) {
                header('Location: adismart_balaraja.php');
                exit;
            }
        }

        if ($menu_id == 5) {
            if ($submenu_id == 51) {
                header('Location: mitra_partner.php');
                exit;
            } elseif ($submenu_id == 52) {
                header('Location: mitra_sponsor.php');
                exit;
            } elseif ($submenu_id == 53) {
                header('Location: mitra_adismart.php');
                exit;
            } elseif ($submenu_id == 56) {
                header('Location: mitra_lokasi.php');
                exit;
            }
        }

        // Tambahkan pengalihan untuk submenu dari menu lain jika diperlukan
    } else {
        // Pengalihan berdasarkan menu_id saja
        if ($menu_id == 1) {
            header('Location: latar_belakang.php');
            exit;
        }
        if ($menu_id == 2) {
            header('Location: berita.php');
            exit;
        }
        if ($menu_id == 3) {
            header('Location: produk.php');
            exit;
        }
        if ($menu_id == 4) {
            header('Location: lokasi.php');
            exit;
        }
        if ($menu_id == 5) {
            header('Location: mitra.php');
            exit;
        }
    }
}


// Query untuk mengambil data perusahaan dari company.php
$queryCompany = "SELECT nama_perusahaan, slogan_perusahaan, alamat FROM company";
$resultCompany = mysqli_query($koneksi, $queryCompany);

$queryLogoPerusahaan = "SELECT * FROM company_logo";
$resultLogoPerusahaan = mysqli_query($koneksi, $queryLogoPerusahaan);

$querySocialIcons = "SELECT * FROM company_social_icons";
$resultSocialIcons = mysqli_query($koneksi, $querySocialIcons);

$queryDokumenter = "SELECT * FROM start_page";
$resultDokumenter = mysqli_query($koneksi, $queryDokumenter);

$queryTentang = "SELECT * FROM tentang";
$resultTentang = mysqli_query($koneksi, $queryTentang);

function getHeaderBackgroundColor()
{
    global $koneksi;
    $query = "SELECT kode_warna FROM warna LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['kode_warna'];
    } else {
        return 'pink';
    }
}

$backgroundColor = getHeaderBackgroundColor();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Reset CSS untuk mereset beberapa gaya default */
        body,
        ul,
        li {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        /* CSS untuk header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: <?php echo $backgroundColor; ?>;
            /* Atur warna header di sini */
            padding: 5px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Hapus transition efek */
            font-size: 16px;
            z-index: 9999;
        }

        /* Hamburger menu */
        .hamburger-menu {
            background-color: transparent;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 20px;
            padding: 1px;
            margin-right: 40px;
            margin-left: 40px;
            position: relative;
        }

        /* Ikon hamburger dan X */
        .hamburger-menu i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Styling untuk kontainer menu */
        .menu-container {
            width: calc(94.5%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border: 0px solid #000;
            /* Tambahkan border agar ujungnya tajam */
            position: absolute;
            top: 120px;
            /* Sesuaikan dengan tinggi header */
            left: 10px;
            display: none;
        }

        /* Styling untuk menu utama dengan font Helvetica */
        .menu-item a {
            font-size: 20px;
            font-family: Helvetica, Arial, sans-serif;
            margin-bottom: 10px;
            /* Ubah margin bottom menjadi 10px */
            padding: 10px 20px;
            /* Tambahkan padding ke menu utama */
            color: white;
            /* Teks utama berwarna putih */
            text-decoration: none;
            /* Hapus dekorasi teks (underline) */
            transition: color 0.3s;
            /* Efek transisi perubahan warna */
            display: block;
            /* Menampilkan menu sebagai blok agar padding dan margin berfungsi dengan baik */
        }

        /* Gaya teks menu saat dihover */
        .menu-item a:hover {
            color: gold;
            /* Teks berubah menjadi warna emas saat dihover */
        }

        /* Gaya untuk submenu yang muncul di sebelah kanan menu */
        .submenu {
            display: none;
            list-style-type: none;
            padding-left: 10px;
            border: 0px solid rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 15px;
            left: 300px;
            /* Ubah jarak dari kanan ke 20px */
        }

        /* Gaya teks untuk submenu dengan font Roboto */
        .submenu li a {
            font-size: 18px;
            font-family: Roboto, Arial, sans-serif;
            margin-top: 10px;
            margin-bottom: 15px;
            /* Ubah margin bottom menjadi 15px */
            color: white;
            /* Teks submenu berwarna putih */
            text-decoration: none;
            /* Hapus dekorasi teks (underline) */
            transition: color 0.3s;
            /* Efek transisi perubahan warna */
        }

        /* Tampilan awal submenu disembunyikan */
        .menu-item:hover .submenu {
            display: block;
        }

        /* Gaya teks submenu saat dihover */
        .menu-item:hover .submenu li a:hover {
            color: gold;
            /* Teks submenu berubah menjadi warna emas saat dihover */
        }

        /* Mengatur lebar logo dan konten header */
        .logo-list {
            display: flex;
            align-items: center;
            margin-top: 5px;
            margin-right: auto;
            /* Ubah menjadi "auto" agar posisi kanan mengikuti ukuran header */
            margin-left: 20px;
        }

        /* Logo dan nama perusahaan */
        .company-info {
            text-align: left;
            margin-right: 0px;
            margin-left: 0px;
            color: white;
        }

        .company-info h2 {
            font-size: 18.5px;
            margin: 0;
            color: white;
        }

        .company-info p {
            font-size: 14px;
            text-align: center;
            margin: 0;
            color: white;
        }

        .company-info .address {
            font-size: 13.5px;
            margin-top: 5px;
            color: white;
        }

        /* Menampilkan ikon media sosial perusahaan */
        .social-icons {
            margin-left: 120px;
        }

        .social-icons a {
            margin-right: 10px;
        }


        @media (max-width: 768px) {
            /* Gaya CSS untuk tampilan ponsel */
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            /* Gaya CSS untuk tampilan tablet */
        }

        @media (min-width: 1025px) {
            /* Gaya CSS untuk tampilan desktop */
        }
    </style>
</head>

<body>
    <header>
        <button class="hamburger-menu" id="hamburgerMenu">
            <i class="fas fa-bars"></i> <!-- Ikon hamburger -->
            <i class="fas fa-times" style="display: none;"></i> <!-- Ikon X -->
        </button>

        <div class="menu-container">
            <ul id="menu-list">
                <?php
                $menus = getAllMenu();
                while ($menu = mysqli_fetch_assoc($menus)) {
                    echo '<li class="menu-item" data-menuid="' . $menu['id'] . '">';
                    echo '<a href="index.php?menu_id=' . $menu['id'] . '">' . $menu['nama_menu'] . '</a>';
                    $submenus = tampilDataSubmenu($menu['id']);
                    if (mysqli_num_rows($submenus) > 0) {
                        echo '<ul class="submenu">';
                        while ($submenu = mysqli_fetch_assoc($submenus)) {
                            echo '<li>';
                            echo '<a href="index.php?menu_id=' . $menu['id'] . '&submenu_id=' . $submenu['id'] . '">';
                            echo $submenu['nama_submenu'];
                            echo '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <div class="logo-list">
            <div class="logo-item left-logo">
                <?php
                if (mysqli_num_rows($resultLogoPerusahaan) > 0) {
                    $logoPerusahaan = mysqli_fetch_assoc($resultLogoPerusahaan);
                    $logoSize1 = 75; // Atur ukuran Logo 1 di sini (misalnya, 100px)
                    echo '<img src="' . $logoPerusahaan['logo_perusahaan'] . '" alt="Logo Perusahaan Kiri"
                     style="max-width: ' . $logoSize1 . 'px; height: auto; margin-right: 10px; margin-left: 150px;">';
                }
                ?>
            </div>
            <div class="company-info">
                <?php
                if (mysqli_num_rows($resultCompany) > 0) {
                    while ($company = mysqli_fetch_assoc($resultCompany)) {
                        echo '<h2 style="font-family: Helvetica, sans-serif;">' . $company['nama_perusahaan'] . '</h2>';
                        echo '<p style="font-family: Helvetica, sans-serif;">' . $company['slogan_perusahaan'] . '</p>';
                        echo '<p class="address">' . $company['alamat'] . '</p>';
                    }
                }
                ?>
            </div>
            <div class="logo-item right-logo">
                <?php
                if (mysqli_num_rows($resultLogoPerusahaan) > 1) {
                    mysqli_data_seek($resultLogoPerusahaan, 1); // Memindahkan kursor ke logo kedua
                    $logoPerusahaan = mysqli_fetch_assoc($resultLogoPerusahaan);
                    $logoSize2 = 100; // Atur ukuran Logo 2 di sini (misalnya, 120px)
                    echo '<img src="' . $logoPerusahaan['logo_perusahaan'] . '" alt="Logo Perusahaan Kanan"
                     style="max-width: ' . $logoSize2 . 'px; height: auto; margin-right: 10px;">';
                }
                ?>
            </div>

            <!-- Menampilkan ikon media sosial perusahaan -->
            <div class="social-icons">
                <?php
                while ($socialIcon = mysqli_fetch_assoc($resultSocialIcons)) {
                    echo '<a href="' . $socialIcon['icon_url'] . '" target="_blank">';
                    echo '<img src="uploads/' . $socialIcon['icon_name'] . '" alt="' . $socialIcon['icon_name'] . '" width="20" height="20">';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
    </header>

    <script>
        var hamburgerMenu = document.getElementById('hamburgerMenu');
        var menuContainer = document.querySelector('.menu-container');
        var isOpen = false;

        hamburgerMenu.addEventListener('click', function() {
            isOpen = !isOpen;

            if (isOpen) {
                menuContainer.style.display = 'block';
                hamburgerMenu.querySelector('.fa-bars').style.display = 'none';
                hamburgerMenu.querySelector('.fa-times').style.display = 'block';
            } else {
                menuContainer.style.display = 'none';
                hamburgerMenu.querySelector('.fa-bars').style.display = 'block';
                hamburgerMenu.querySelector('.fa-times').style.display = 'none';
            }
        });

        // Ambil semua elemen menu
        var menuItems = document.querySelectorAll('.menu-item');


        // Tambahkan event listener pada setiap elemen menu
        menuItems.forEach(function(menuItem) {
            menuItem.addEventListener('mouseenter', function() {
                // Tampilkan submenu ketika kursor masuk ke menu
                var submenu = this.querySelector('.submenu');
                if (submenu) {
                    submenu.style.display = 'block';
                }
                // Ganti warna teks menu menjadi gold
                this.style.color = 'gold';
            });

            menuItem.addEventListener('mouseleave', function() {
                // Sembunyikan submenu ketika kursor keluar dari menu
                var submenu = this.querySelector('.submenu');
                if (submenu) {
                    submenu.style.display = 'none';
                }
                // Kembalikan warna teks menu ke warna aslinya
                this.style.color = '';
            });
        });
    </script>


</body>

</html>