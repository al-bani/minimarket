<?php include('../server/conn.php');

if (!isset($_SESSION['status'])) {
    header('location: ../login.php');
    exit;
}

$product_id = $_GET['product_id'];

$product_id_check = mysqli_query($conn, "SELECT product_id FROM products");

while ($row = mysqli_fetch_row($product_id_check)) {
    foreach ($row as $element => $value) {
        if (!is_numeric($product_id) || $product_id == NULL) {
            $status_product_id = TRUE;
        }

        if ($value == $product_id) {
            $status_product_id = TRUE;
        }
    }
}

if ($status_product_id != TRUE) {
    header('location: index.php');
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM products where product_id = $product_id");

while ($row = mysqli_fetch_array($query)) {
    $product_name_old = $row['product_name'];
    $product_price_old = $row['product_price'];
    $product_desc_old = $row['product_desc'];
    $product_stok_old = $row['product_stok'];
    $product_photo_old = $row['product_photo'];
}

if (isset($_POST['btn_update'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_stok = $_POST['product_stok'];
    $product_photo = $_POST['product_photo'];

    $query = "UPDATE products SET product_name = '$product_name',
                                        product_price = '$product_price',
                                        product_desc = '$product_desc',
                                        product_stok = '$product_stok',
                                        product_photo = '$product_photo'
                                        WHERE product_id = $product_id";

    $res = mysqli_query($conn, $query);

    if ($res) {
        echo "<script>alert('Update Product berhasil')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Update Product gagal')</script>";
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
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link rel="icon" href="../img/logo/logo.png" type="image/icon type">
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
    <title>Manage Product</title>
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


    <!-- Form Update -->
    <form action="update.php?product_id=<?= $product_id ?>" method="post">
        <div class="row">
            <div class="col-md-4 offset-md-4 form register-form">
                <form action="" method="post">
                    <h2 class="text-center">Update Order</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_name" placeholder="Name" value="<?= $product_name_old ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="product_price" placeholder="price" value="<?= $product_price_old ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="product_desc" placeholder="desc" value="<?= $product_desc_old ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="product_stok" placeholder="stok" value="<?= $product_stok_old ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="product_photo" placeholder="photo" value="<?= $product_photo_old ?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="form-control button" name="btn_update" value="Update">
                    </div>
                </form>
            </div>
        </div>
</body>

</html>