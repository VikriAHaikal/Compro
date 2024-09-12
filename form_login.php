<?php
session_start();
if (isset($_POST['u_name'])) {
    require 'koneksi.php';
    $username = $_POST['u_name'];
    $password = md5($_POST['pass']);

    $sql = "SELECT nama FROM users WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($sql) or die($koneksi->error);

    if ($result->num_rows > 0) {
        $data = $result->fetch_object();
        $_SESSION['nama'] = $data->nama;
        header('Location: dashboard.php');
        exit();
    } else {
        $errorMessage = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Super Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
        background: url('bgs.gif');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 30px;
            color: #fff;
        }

        .card-title {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .alert {
            border-radius: 10px;
        }

        .form-control {
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 10px;
            transition: border-color 0.3s ease-in-out;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .form-control:focus {
            border-color: #3490dc;
            box-shadow: none;
        }

        .btn-primary {
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 18px;
            width: 100%;
            background-color: #3490dc;
            border-color: #3490dc;
        }

        .btn-primary:hover {
            background-color: #2779bd;
            border-color: #2779bd;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

    .logo1 img {
        width: 80px;
        height: auto;
    }
    .logo2 img {
        width: 100px;
        height: auto;
    }
    .logo3 img {
        width: 100px;
        height: auto;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="logo-container">
            <div class="logo1">
                <img src="kopkars.png" alt="Logo 1">
            </div>
            <div class="logo2">
                <img src="adis.png" alt="Logo 2">
            </div>
            <div class="logo3">
                <img src="adfs.png" alt="Logo 3">
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login Super Admin</h2>

                <?php if (isset($errorMessage)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php } ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="u_name" class="form-label">Username:</label>
                        <input type="text" id="u_name" name="u_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Password:</label>
                        <input type="password" id="pass" name="pass" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>