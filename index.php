<?php include("server/conn.php");

    if(!isset($_SESSION['status'])){
        header('location: login.php');
        exit;
    }

    if(isset($_GET['logout'])){
        if(isset($_SESSION['status'])){
            unset($_SESSION['status']);
            unset($_SESSION['email']);
            unset($_SESSION['name']);
            unset($_SESSION['address']);
            unset($_SESSION['phone']);
            unset($_SESSION['photo']);
            unset($_SESSION['admin_id']);
            echo "<script>alert('Logout Berhasil')</script>";
            echo "<script>window.location.href='login.php'</script>";
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
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
            <div class="menu">
                <ul>
                    <li><a href="products/">Manage Product</a></li>
                    <li><a href="orders/">Manage Orders</a></li>
                   
                </ul>
            </div>
        </div>
        <div class="about">
            <img src="<?= $_SESSION['photo'] ?>" class="rounded-img">
            <h2><?= $_SESSION['name'] ?></h2>
            <h4><?= $_SESSION['address'] ?></h4>
            <h3><?= $_SESSION['email'] ?></h3>
            <h3><?= $_SESSION['phone'] ?></h3>
            <input type="submit" onclick="location.href='update-profil.php'" class="btn-green" value="Update">
            <input type="submit"  onclick="location.href='index.php?logout=success'" class="btn-red" value="logout">
        </div>
    </div>
</body>
</html>