<?php include("server/conn.php");

if (isset($_SESSION['status'])) {
    header('location: dashboard.php');
}


if (isset($_POST['btn_register'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $photo = $_POST['photo'];

    if ($password == $confirm_password) {
        $sql = "INSERT INTO admin (email, name, password, address, phone, photo) VALUES ('$email', '$name', '$password', '$address', '$phone', '$photo')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Akun Berhasil dibuat')</script>";
            echo "<script>window.location.href='login.php'</script>"; 
        } else {
            echo "<script>alert('Register Gagal')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sama')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo/logo.png" type="image/icon type">
    <title>Register</title>
</head>

<body>
    <!-- NAVBAR -->
    <header>
        <img src="img/logo/logo.png" alt="logo">
        <nav>
            <div class="nav__links">
                <ul>
                    <li><a href="about.html"><button>About</button></a></li>
                    <li><a href="login.php"><button>Masuk</button></a></li>
                    <li><a href="register.php"><button>Daftar</button></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Register Form -->
    <div class="container">
        <div class="row" style="padding-top: 200px;">
            <div class="col-md-4 offset-md-4 form register-form">
                <form method="POST" action="register.php">
                    <h2 class="text-center">Register</h2>
                    <p class="text-center">Buat Akun untuk Bisa Mengakses Alfatihah</p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="confirm-password" placeholder="Konfirmasi Password" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Phone" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="photo" placeholder="photo" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control button" name="btn_register" value="Register">
                    </div>
                    <div class="link login-link text-center">Sudah Punya Akun? <a href="login.php">login disini</a></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>