<?php include("../server/conn.php");

    if (!isset($_SESSION['status'])) {
        header('location: ../index.php');
    }

    $query = "SELECT product_id FROM products";
    $result = mysqli_query($conn, $query);

    if (isset($_POST['btn_orders'])) {
        $product_id = $_POST['product_id'];
        $queryForPrice = mysqli_query($conn, "SELECT product_price FROM products WHERE product_id = $product_id");
        $priceArr = mysqli_fetch_row($queryForPrice);
        $price = $priceArr[0];

        $qty = $_POST['order_qty'];
        $product_id = $_POST['product_id'];
        $admin_id = $_SESSION['admin_id'];
        $total = $qty * $price;
        $date = date('Y/m/d', time());

        $sql = "INSERT INTO orders (order_qty, product_id, admin_id, order_cost, date) VALUES ('$qty', '$product_id', '$admin_id', '$total', '$date')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>alert('Input Order berhasil')</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('Input Order Gagal')</script>";
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
    <title>Manage Product</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <h3>Input Order</h3>
        </div>
        <div>
        </div>
        <div class="box">
            <form method="POST" action="create.php">
                <div class="input">
                    <select name="product_id">
                        <?php while($row = mysqli_fetch_array($result)): ?>
                            <option value="<?= $row['product_id'] ?>"><?= $row['product_id'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    
                    <div class="input">
                        <input type="text" class="Textbox" name="order_qty" placeholder="Quantity" required>
                    </div>
                </div>

                <div class="Submit">
                    <input type="submit" class="button-green" name="btn_orders" value="Create Order">
                </div>
                
            </form>
        </div>
    </div>
</body>

</html>