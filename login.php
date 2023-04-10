<?php include("server/conn.php");

if (isset($_SESSION['status'])) {
    header('location: dashboard.php');
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

    if ($row['email'] == $email && $row['password'] == $password) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['photo'] = $row['photo'];
        $_SESSION['admin_id'] = $row['id'];

        $_SESSION['status'] = TRUE;

        echo "<script>alert('Login Berhasil')</script>";
        echo "<script>window.location.href='dashboard.php'</script>";
    } else {
        echo "<script>alert('Login Gagal')</script>";
        echo "<script>window.location.href='login.php'</script>";
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
    <title>Login</title>
</head>

<body>
    <!-- NAVBAR -->
    <header>
        <img src="img/logo/logo.png" alt="logo">
        <nav>
            <div class="nav__links">
                <ul>
                    <li><a href="#"><button>About</button></a></li>
                    <li><a href="login.php"><button>Masuk</button></a></li>
                    <li><a href="register.php"><button>Daftar</button></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Login Form -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form method="POST" action="login.php">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your email and password</p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control button" name="login_btn" value="Login">
                    </div>
                    <div class="link login-link text-center">Belum Punya akun? <a href="register.php">Daftar Disini</a></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>