<?php
if (isset($_POST['start'])) {
    if (!isset($_SESSION['status'])) {
        header('location: login.php');
        exit;
    } else {
        header('location: dashboard.php');
        exit;
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
    <title>Homepage</title>
    <link rel="icon" href="img/logo/logo.png" type="image/icon type">
</head>

<body>
    <!-- NAVBAR -->
    <header>
        <img src="img/logo/logo.png" alt="logo">
        <nav>
            <div class="nav__links">
                <ul>
                    <li><a href="about.html"><button>About</button></a></li>

                </ul>
            </div>
        </nav>
    </header>


    <!-- content -->
    <div class="split-screen">
        <div class="left-side">
            <img src="img/logo/logo.png" alt="logo">
        </div>
        <div class="right-side">
            <h1>Alfatihah</h1>
            <p>minimarket adalah suatu toko kecil yang umumnya mudah dijangkau oleh khalayak atau masyarakat lokal. Toko
                semacam ini umumnya berlokasi di jalan yang ramai, stasiun pengisian bahan bakar, atau stasiun kereta
                api. oleh karena itu kami ingin membuat web mini market yang dapat memudahkan user dan admin dalam
                mengelola dan mengakses barang belanjaan dimana saja dan kapan saja.</p>
            <a href="">
                <form method="POST" action="index.php">
                    <button name="start" class="btn btn-primary">Mulai Gunakan !</button>
                </form>
            </a>
        </div>
    </div>

</body>

</html>