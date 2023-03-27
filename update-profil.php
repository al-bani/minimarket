<?php include("server/conn.php");
        $id = $_SESSION['admin_id'];
    
        if(!isset($_SESSION['status'])){
            header('location: login.php');
            exit;
        }

        $query = mysqli_query($conn, "SELECT password FROM admin WHERE id = $id");
        $row = mysqli_fetch_row($query);
        $old_pw = $row[0];
        
        if(isset($_POST['btn_update'])){    
            if($_POST['old_password'] == $old_pw){
                $email = $_POST['email'];
                $name = $_POST['name'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm-password'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $photo = $_POST['photo'];   
        
                if($password == $confirm_password){
                    if($password == NULL){
                        $password = $old_pw;
                    }

                    $sql = "UPDATE admin SET email = '$email',
                                            name = '$name',
                                            password = '$password',
                                            address = '$address',
                                            phone = '$phone',
                                            photo = '$photo'
                                            WHERE id = '$id'";

                    $query = mysqli_query($conn, $sql);
                    if($query){
                        echo "<script>alert('Profil Berhasil di Update')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    }else{
                        echo "<script>alert('Update Gagal')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    }
                } else {
                    echo "<script>alert('Password baru Tidak Sama')</script>";
                }            
            }else{
                echo "<script>alert('Password lama tidak sesuai')</script>";
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
    <title>Update Profil</title>
    
</head>
<body>
<script>
    function check(){
        if(document.getElementById('cb_pass').checked){
            document.getElementById('pass').disabled = false;
            document.getElementById('confirm-pass').disabled = false;
        } else {
            document.getElementById('pass').disabled = true;
            document.getElementById('confirm-pass').disabled = true;
        }
    }
</script>
    <div class="container">
        <div class="top">
            <h3>Update Profil</h3>
        </div>
        <div class="box">
            <form method="POST" action="update-profil.php">
                <div class="input">
                    <input type="text" class="Textbox" name="email" placeholder="Email" value="<?= $_SESSION['email']; ?>" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="name" placeholder="Name" value="<?= $_SESSION['name']; ?>" required>
                </div>
                <div class="input">
                    <input type="password" class="Textbox" name="old_password" placeholder="Old Password" required>
                </div>
                    <input type="checkbox" id="cb_pass" onclick="check();"><label for="cb_pass">Ubah Password</label>
                <div class="input">
                    <input type="password" class="Textbox" name="password" id="pass" placeholder="New Password" disabled required>
                </div>
                <div class="input">
                    <input type="password" class="Textbox" name="confirm-password" id="confirm-pass" placeholder="Confirm New Password" disabled required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="address" placeholder="Address" value="<?= $_SESSION['address']; ?>" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="phone" placeholder="Phone Number" value="<?= $_SESSION['phone']; ?>" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="photo" placeholder="Photo" value="<?= $_SESSION['photo']; ?>" required>
                </div>
                <div class="input">
                    <input type="submit" class="btn-green" name="btn_update" value="Update">
                    <input type="submit" class="btn-green" name="btn_update" onclick="location.href='index.php'" value="Kembali">
                </div>
            </form>
        </div>
    </div>
</body>
</html>