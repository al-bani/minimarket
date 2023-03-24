<?php include("server/conn.php");

    if(isset($_SESSION['status'])){
        header('location: index.php');
    }
    
    if(isset($_POST['btn_register'])){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $photo = $_POST['photo'];

        if($password == $confirm_password){
            $sql = "INSERT INTO admin (email, name, password, address, phone, photo) VALUES ('$email', '$name', '$password', '$address', '$phone', '$photo')";
            $query = mysqli_query($conn, $sql);
            if($query){
                echo "<script>alert('Register Berhasil')</script>";
                echo "<script>window.location.href='login.php'</script>";
            }else{
                echo "<script>alert('Register Gagal')</script>";
                echo "<script>window.location.href='register.php'</script>";
            }
        }else{
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
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <h3>Register Page</h3>
        </div>
        <div class="box">
            <form method="POST" action="register.php">
                <div class="input">
                    <input type="text" class="Textbox" name="email" placeholder="Email" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="name" placeholder="Name" required>
                </div>
                <div class="input">
                    <input type="password" class="Textbox" name="password" placeholder="Password" required>
                </div>
                <div class="input">
                    <input type="password" class="Textbox" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="address" placeholder="Address" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="photo" placeholder="URL Photo" required>
                </div>
                <div class="Submit">
                    <input type="submit" class="button-green" name="btn_register" value="Register">
                </div>
                <h5>Sudah Buat Akun? <a href="login.php">Login Disini</a></h5>
            </form>
        </div>
    </div>
</body>
</html>