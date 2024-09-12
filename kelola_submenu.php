<?php
require_once 'koneksi.php';

// Fungsi-fungsi untuk mengakses database
function tambahSubmenu($menu_id, $nama_submenu)
{
    global $koneksi;
    $sql = "INSERT INTO submenu (menu_id, nama_submenu) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'is', $menu_id, $nama_submenu);
    return mysqli_stmt_execute($stmt);
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $menu_id = $_POST['menu_id'];
        $nama_submenu = mysqli_real_escape_string($koneksi, $_POST['nama_submenu']);

        if (!empty($nama_submenu)) {
            if (tambahSubmenu($menu_id, $nama_submenu)) {
                header("Location: kelola_submenu.php?menu_id=$menu_id");
                exit();
            } else {
                $error = "Gagal menambahkan submenu.";
            }
        } else {
            $error = "Nama submenu tidak boleh kosong.";
        }
    }

    if (isset($_POST['edit_submenu_id']) && isset($_POST['edited_submenu_name'])) {
        $edit_submenu_id = $_POST['edit_submenu_id'];
        $edited_submenu_name = $_POST['edited_submenu_name'];

        $sql = "UPDATE submenu SET nama_submenu = ? WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $edited_submenu_name, $edit_submenu_id);
        if (mysqli_stmt_execute($stmt)) {
            $menu_id = $_POST['menu_id'];
            header("Location: kelola_submenu.php?menu_id=$menu_id");
            exit();
        } else {
            $error = "Gagal mengedit submenu.";
        }
    }

    if (isset($_POST['delete_submenu_id'])) {
        $delete_submenu_id = $_POST['delete_submenu_id'];

        $sql = "DELETE FROM submenu WHERE id=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $delete_submenu_id);
        if (mysqli_stmt_execute($stmt)) {
            $menu_id = $_POST['menu_id'];
            header("Location: kelola_submenu.php?menu_id=$menu_id");
            exit();
        } else {
            $error = "Gagal menghapus submenu.";
        }
    }
}

$menu_id = isset($_GET['menu_id']) ? $_GET['menu_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Submenu</title>
    <style>
        /* Reset beberapa gaya default browser */
        body {
            background: url("bgs.gif");
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
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin: 50px auto;
            padding: 20px;
            max-width: 600px;
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

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid rgba(0, 0, 0, 0.0);
            border-radius: 3px;
            font-size: 14px;
            background: rgba(0, 0, 0, 0.0);
            color: #fff;
        }

        button[type="submit"] {
            background-color: #5f5380;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: none;
        }

        /* Menampilkan daftar submenu */
        ul.submenu {
            list-style: none;
            padding: 0;
        }

        ul.submenu li {
            background-color: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            text-align: center;
            padding: 10px;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            color: #fff;
        }

        /* Tombol edit dan hapus submenu */
        .submenu-actions a {
            margin-left: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .submenu-actions a:hover {
            color: #eb4034;
        }

        /* Menu yang dipilih dan submenu yang ditampilkan */
        .menu-item.selected,
        ul.submenu {
            color: #fff;
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
        }

        .notification {
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
    <h1>Kelola Submenu</h1>
    <?php
    if (isset($error)) {
        echo '<div class="notification">' . $error . '</div>';
    }
    ?>
    <form method="POST">
        <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>">
        <label>Nama Submenu:</label>
        <input type="text" name="nama_submenu" required>
        <button type="submit" name="submit">Tambah Submenu</button>
    </form>

    <ul class="submenu">
        <?php
        if ($menu_id !== null) {
            $submenus = tampilDataSubmenu($menu_id);
            if ($submenus->num_rows > 0) {
                while ($submenu = $submenus->fetch_assoc()) {
                    $submenuId = $submenu['id'];
                    $submenuName = $submenu['nama_submenu'];

                    // Tampilkan submenu sebagai elemen HTML yang dapat diedit dengan PHP
                    echo '<li id="submenu-' . $submenuId . '">';
                    echo '<span class="submenu-name">' . $submenuName . '</span>';
                    echo '<span class="submenu-actions">';
                    echo '<a href="javascript:void(0);" onclick="editSubmenu(' . $menu_id . ', ' . $submenuId . ')">Edit</a> ';
                    echo '<a href="javascript:void(0);" onclick="deleteSubmenu(' . $menu_id . ', ' . $submenuId . ')">Delete</a>';
                    echo '</span>';
                    echo '</li>';
                }
            } else {
                echo '<p>Tidak ada submenu yang ditemukan.</p>';
            }
        } else {
            echo '<p>Menu ID tidak ditemukan.</p>';
        }
        ?>
    </ul>

    <a href="kelola_menu.php" class="back-button">Kembali ke Menu</a>
</div>

<script>
    function editSubmenu(menuId, submenuId) {
        const submenuElement = document.getElementById('submenu-' + submenuId);
        const submenuNameElement = submenuElement.querySelector('.submenu-name');

        const currentName = submenuNameElement.textContent;

        submenuNameElement.innerHTML = `
            <form method="POST" action="kelola_submenu.php">
                <input type="hidden" name="menu_id" value="${menuId}">
                <input type="hidden" name="edit_submenu_id" value="${submenuId}">
                <input type="text" name="edited_submenu_name" value="${currentName}" required>
                <button type="submit">Simpan</button>
                <button type="button" onclick="batalEdit(${menuId}, ${submenuId}, '${currentName}')">Batal</button>
            </form>
        `;
    }

    function batalEdit(menuId, submenuId, originalName) {
        const submenuElement = document.getElementById('submenu-' + submenuId);
        const submenuNameElement = submenuElement.querySelector('.submenu-name');
        submenuNameElement.textContent = originalName;

        window.location.href = 'kelola_submenu.php?menu_id=' + menuId;
    }

    function deleteSubmenu(menuId, submenuId) {
        const confirmation = confirm("Apakah Anda yakin ingin menghapus submenu ini?");
        if (confirmation) {
            fetch('kelola_submenu.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'menu_id=' + menuId + '&delete_submenu_id=' + submenuId,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                if (data.includes('Berhasil menghapus submenu')) {
                    alert('Berhasil menghapus submenu.');
                    const submenuElement = document.getElementById('submenu-' + submenuId);
                    submenuElement.remove();
                } else {
                    alert('Gagal menghapus submenu: localhost says ' + data);
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error.message);
            });
        }
    }
</script>
</body>
</html>
