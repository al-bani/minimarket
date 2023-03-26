<?php include("server/conn.php");

    if(isset($_SESSION['status'])){
        header('location: index.php');
    }

    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $query = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_array($query);

        if($row['email'] == $email && $row['password'] == $password){
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['photo'] = $row['photo'];
            $_SESSION['admin_id'] = $row['id'];

            $_SESSION['status'] = TRUE;
            
            echo "<script>alert('Login Berhasil')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{
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
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <h3>Login Page</h3>
        </div>
            <div class="box">
                <form method="POST" action="login.php">
                    <div class="input">
                        <input type="text" class="Textbox" name="email" placeholder="Email" required>
                    </div>
                    <div class="input">
                        <input type="password" class="Textbox" name="password" placeholder="Password" required>
                    </div>
                    <div class="Submit">
                        <input type="submit" class="button-blue" name="login_btn" value="Login">
                    </div>
                    <h5>Belum Punya Akun? <a href="register.php">Daftar Disini</a></h5>
                </form>
            </div>
    </div>
</body>
</html>