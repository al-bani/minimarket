<?php include("server/conn.php");
$id = $_SESSION['admin_id'];

if (!isset($_SESSION['status'])) {
    header('location: login.php');
    exit;
}

$query = mysqli_query($conn, "SELECT password FROM admin WHERE id = $id");
$row = mysqli_fetch_row($query);
$old_pw = $row[0];

if (isset($_POST['btn_update'])) {
    if ($_POST['old_password'] == $old_pw) {
        $email = $_POST['email'];
        $name = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $photo = $_POST['photo'];

        if ($password == $confirm_password) {
            if ($password == NULL) {
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
            if ($query) {
                echo "<script>alert('Profil Berhasil di Update')</script>";
                $queryUpdate = "SELECT * FROM admin WHERE id = $id";
                $result = mysqli_query($conn, $queryUpdate);
                $row = mysqli_fetch_array($result);

                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['admin_id'] = $row['id'];

                echo "<script>location.href='dashboard.php';</script>";
            } else {
                echo "<script>alert('Update Gagal')</script>";
                echo "<script>location.href='update-profile.php';</script>";
            }
        } else {
            echo "<script>alert('Password baru Tidak Sama')</script>";
        }
    } else {
        echo "<script>alert('Password lama tidak sesuai')</script>";
    }
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['status'])) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo/logo.png" type="image/icon type">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
        function changeFunc() {
            var selectBox = document.getElementById("selectbox");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            if (selectedValue == 1) {
                location.href = 'update-profile.php';
            } else if (selectedValue == 2) {
                location.href = 'dashboard.php?logout=success';
            }
        }
    </script>
    <title>Update Profile</title>
</head>

<body>
    <script>
        function check() {
            if (document.getElementById('cb_pass').checked) {
                document.getElementById('pass').disabled = false;
                document.getElementById('confirm-pass').disabled = false;
            } else {
                document.getElementById('pass').disabled = true;
                document.getElementById('confirm-pass').disabled = true;
            }
        }
    </script>
    <!-- NAVBAR -->
    <header>
        <img src="img/logo/logo.png" alt="logo">
        <nav>
            <div class="nav__links">
                <ul>
                    <li><a href="about.html"><button>About</button></a></li>
                    <div class="select">
                        <select class="select-header" id="selectbox" onchange="changeFunc();">
                            <option hidden Selected><?= $_SESSION['name'] ?></option>
                            <option value="1">My Account</option>
                            <option value="2">Logout</option>
                        </select>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Back -->
    <div class="back__button">
        <a href="dashboard.php">
            <ion-icon name="chevron-back"></ion-icon>
        </a>
    </div>

    <!-- Update Profile Form -->

    <!-- Profile data -->
    <div class="row">
        <div class="col-md-4 offset-md-4 form register-form">
            <form method="POST" action="update-profile.php">
                <h2 class="text-center">Update Profile</h2>
                <div class="update__profile" style="align-items: center; text-align: center;">
                    <img src="<?= $_SESSION['photo'] ?>" alt="">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $_SESSION['email'] ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $_SESSION['name'] ?>" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="old_password" placeholder="Old Password" required>
                </div>
                <div class="check">
                    <div class="form-group">
                        <input type="checkbox" class="form-control custom-checkbox" style="display: inline-block; vertical-align: middle;" id="cb_pass" onclick="check();">
                        <label for="form-control custom-checkbox" style="display: inline-block; vertical-align: middle;">Buat Password Baru</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password Baru" id="pass" disabled>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password" id="confirm-pass" disabled>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Address" value="<?= $_SESSION['address'] ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="<?= $_SESSION['phone'] ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="photo" placeholder="Photo" value="<?= $_SESSION['photo'] ?>" required>
                </div>

                <!-- PRofile Picture-->

                <div class="form-group">
                    <input type="submit" class="form-control button" name="btn_update" value="Save Shanges">
                </div>
            </form>
        </div>
    </div>
</body>

</html>