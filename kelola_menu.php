<?php
require_once 'koneksi.php';

// Fungsi-fungsi untuk mengakses database
function getAllMenu()
{
    global $koneksi;
    $query = "SELECT * FROM menu";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

function getSubmenuByMenuId($menu_id)
{
    global $koneksi;
    $query = "SELECT * FROM submenu WHERE menu_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $menu_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function insertMenu($company_id, $nama_menu)
{
    global $koneksi;
    $query = "INSERT INTO menu (company_id, nama_menu) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'is', $company_id, $nama_menu);
    mysqli_stmt_execute($stmt);
}

function updateMenu($menu_id, $nama_menu)
{
    global $koneksi;
    $query = "UPDATE menu SET nama_menu=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'si', $nama_menu, $menu_id);
    mysqli_stmt_execute($stmt);
}

function deleteMenu($menu_id)
{
    global $koneksi;

    // Hapus submenu terlebih dahulu
    $queryDeleteSubmenu = "DELETE FROM submenu WHERE menu_id=?";
    $stmtDeleteSubmenu = mysqli_prepare($koneksi, $queryDeleteSubmenu);
    mysqli_stmt_bind_param($stmtDeleteSubmenu, 'i', $menu_id);
    mysqli_stmt_execute($stmtDeleteSubmenu);

    // Hapus menu
    $query = "DELETE FROM menu WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $menu_id);
    mysqli_stmt_execute($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Reset beberapa gaya default browser */
        body {
            background: url('bgs.gif');
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Styling untuk konten utama */
        .container {
            background-color: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
        }

        h1 {
            color: white;
            padding: 10px;
        }

        h2 {
            color: white;
            margin-top: 20px;
            cursor: pointer; /* Tambahkan cursor pointer untuk menandakan bahwa menu dapat diklik */
        }

        /* Styling untuk tombol "Edit" dan "Delete" */
        .edit-button,
        .delete-button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
            margin-left: 5px;
            text-decoration: none;
        }

        .edit-button:hover,
        .delete-button:hover {
            background-color: #0056b3;
        }

        /* Penataan submenu lebih rapi */
        ul {
            list-style: none;
            padding: 0;
            margin-top: 10px;
            /* Berikan sedikit ruang antara daftar menu dan submenu */
        }

        ul li {
            display: none; /* Sembunyikan submenu secara default */
            color: white;
            margin: 5px 0;
            /* Tambahkan border agar submenu terlihat lebih terpisah */
            padding: 5px 10px;
            /* Berikan sedikit padding pada submenu */
            border-radius: 3px;
            background-color: none;
            /* Latar belakang transparan untuk submenu */
        }

        /* Link styling */
        a {
            color: #007BFF;
            text-decoration: none;
            margin-top: 10px;
            display: block;
        }

        a:hover {
            color: #0056b3;
        }
    </style>

    <meta charset="UTF-8">
    <title>Company Profile Menu</title>
</head>

<body>
    <div class="container">
        <h1>Kelola Menu dan Sub Menu</h1>

      <!-- Menampilkan daftar menu -->
      <?php
        $menus = getAllMenu();
        while ($menu = mysqli_fetch_assoc($menus)) {
            echo "<h2><a href='kelola_submenu.php?menu_id=" . $menu['id'] . "'>" . $menu['nama_menu'] . "</a></h2>";
            echo "<p>" . $menu['deskripsi'] . "</p>"; // Menampilkan deskripsi menu
            // Menampilkan submenu
            $submenus = getSubmenuByMenuId($menu['id']);
            echo "<ul class='submenu-list'>";
            while ($submenu = mysqli_fetch_assoc($submenus)) {
                echo "<li>" . $submenu['nama_submenu'] . "</li>";
            }
            echo "</ul>";
        }
        ?>

        <!-- Tombol "Tambah Menu dan Submenu" -->
        <a href="kelola_header.php?menu_id=new" class="add-menu-button">Kembali ke Kelola Header</a>
    </div>
</body>
</html>
