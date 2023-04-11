<?php include('../server/conn.php');

if (!isset($_SESSION['status'])) {
    header('location: ../login.php');
    exit;
}

if (isset($_POST['btn_submit'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_stok = $_POST['product_stok'];
    $product_photo = $_POST['product_photo'];

    $sql = "INSERT INTO products (product_name, product_price, product_desc, 
        product_stok, product_photo) VALUES ('$product_name', '$product_price', '$product_desc', '$product_stok', '$product_photo')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('location: index.php');
    } else {
        echo "<script>alert('Input Order Gagal')</script>";
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="icon" href="../img/logo/logo.png" type="image/icon type">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
        function changeFunc() {
            var selectBox = document.getElementById("selectbox");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            if (selectedValue == 1) {
                location.href = '../update-profile.php';
            } else if (selectedValue == 2) {
                location.href = '../dashboard.php?logout=success';
            }
        }
    </script>
    <title>Create Product</title>
</head>

<body>
    <!-- NAVBAR -->
    <header>
        <img src="../img/logo/logo.png" alt="logo">
        <nav>
            <div class="nav__links">
                <ul>
                    <li><a href="../about.html"><button>About</button></a></li>

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
        <a href="index.php">
            <ion-icon name="chevron-back"></ion-icon>
        </a>
    </div>


    <!-- Create Form-->
    <div class="col-md-4 offset-md-4 form register-form">
        <form method="POST" action="create.php">
            <h2 class="text-center">Insert Product</h2>
            <div class="form-group">
                <input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="product_price" placeholder="Product Price" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="product_desc" placeholder="Product Description" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="product_stok" min="1" placeholder="Stock" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="product_photo" placeholder="URL Image" required>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control button" name="btn_submit" value="submit">
            </div>
        </form>
    </div>




</body>

</html>