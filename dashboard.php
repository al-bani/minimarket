<?php include("server/conn.php");

if (!isset($_SESSION['status'])) {
    header('location: login.php');
    exit;
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
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="icon" href="img/logo/logo.png" type="image/icon type">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://example.com/fontawesome/v6.4.0/js/fontawesome.js" data-auto-replace-svg="nest"></script>
    <script src="https://example.com/fontawesome/v6.4.0/js/solid.js"></script>
    <script src="https://example.com/fontawesome/v6.4.0/js/brands.js"></script>
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
    <title>Dashboard</title>
</head>

<body>
    <!-- NAVBAR -->
    <header>
        <img src="img/logo/logo.png" alt="logo">
        <nav>
            <div class="nav__links">
                <ul>
                    <li><a href="#"><button>About</button></a></li>
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

    <!-- content -->
    <!-- Left Content -->
    <div class="split left">
        <div class="centered">
            <div class="btn__dash">
                <a href="products/">
                    <button>
                        <ion-icon name="cube-outline"></ion-icon>
                        <br>
                        <h1>Manage Products</h1>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Right Content -->
    <div class="split right">
        <div class="centered">
            <div class="btn__dash">
                <a href="orders/">
                    <button>
                        <ion-icon name="receipt-outline"></ion-icon>
                        <br>
                        <h1>Manage Orders</h1>
                    </button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>