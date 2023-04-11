<?php include("../server/conn.php");

if (!isset($_SESSION['status'])) {
    header('location: ../login.php');
    exit;
}

$order_id = $_GET['order_id'];
$order_id_check = mysqli_query($conn, "SELECT order_id FROM orders");

while ($row = mysqli_fetch_row($order_id_check)) {
    foreach ($row as $element => $value) {
        if (!is_numeric($order_id) || $order_id == NULL) {
            $status_order_id = TRUE;
        }

        if ($value == $order_id) {
            $status_order_id = TRUE;
        }
    }
}

if ($status_order_id != TRUE) {
    header('location: index.php');
    exit;
}

$query = "SELECT product_id FROM products";
$result = mysqli_query($conn, $query);

$query = mysqli_query($conn, "SELECT * FROM orders where order_id='$order_id'");

while ($row = mysqli_fetch_array($query)) {
    $admin_id_old = $row['admin_id'];
    $product_id_old = $row['product_id'];
    $order_qty_old = $row['order_qty'];
    $order_cost_old = $row['order_cost'];
}

if (isset($_POST['btn_update'])) {
    $product_id = $_POST['prod_id'];
    $queryForPrice = mysqli_query($conn, "SELECT product_price FROM products WHERE product_id = $product_id");
    $priceArr = mysqli_fetch_row($queryForPrice);
    $price = $priceArr[0];

    $qty = $_POST['order_qty'];
    $admin_id = $_SESSION['admin_id'];
    $total = $qty * $price;
    $date = date('Y/m/d', time());

    $query = "UPDATE orders SET admin_id = '$admin_id',
                                    product_id = '$product_id',
                                    order_qty = '$qty',
                                    order_cost = '$total',
                                    date = '$date'
                                    WHERE order_id = $order_id";
    $res = mysqli_query($conn, $query);

    if ($res) {
        echo "<script>alert('Update Order berhasil')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Update Order gagal')</script>";
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
    <title>Manage Order</title>
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

    <!-- Update Form -->
    <div class="col-md-4 offset-md-4 form register-form">
        <form action="update.php?order_id=<?= $order_id ?>" method="post">
            <h2 class="text-center">Update Order</h2>
            <div class="form-group">
                <p>ID Product</p>
                <select name="prod_id" class="form-control" style="cursor:pointer">
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <option value="<?= $row['product_id'] ?>"><?= $row['product_id'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="order_qty" placeholder="Quantity" value="<?= $order_qty_old ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control button" name="btn_update" value="submit">
            </div>
        </form>
    </div>

</body>

</html>