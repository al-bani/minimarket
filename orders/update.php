<?php include("../server/conn.php");

    if(!isset($_SESSION['status'])){
        header('location: ../login.php');
        exit;
    }

    $order_id = $_GET['order_id'];
    $order_id_check = mysqli_query($conn, "SELECT order_id FROM orders");

    while($row = mysqli_fetch_row($order_id_check)){
        foreach($row as $element => $value){
            if(!is_numeric($order_id) || $order_id == NULL){
                $status_order_id = TRUE;
            }

            if($value == $order_id){
                $status_order_id = TRUE;
            }
        }
    }

    if($status_order_id != TRUE){
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

    if(isset($_POST['btn_update'])){  
        $product_id = $_POST['product_id'];
        $queryForPrice = mysqli_query($conn, "SELECT product_price FROM products WHERE product_id = $product_id");
        $priceArr = mysqli_fetch_row($queryForPrice);
        $price = $priceArr[0];

        $qty = $_POST['order_qty'];
        $product_id = $_POST['product_id'];
        $admin_id = $_SESSION['admin_id'];
        $total = $qty * $price;
        $date = date('Y/m/d', time());

        $query = "UPDATE orders SET admin_id = '$admin_id',
                                    product_id = '$product_id',
                                    order_qty = '$qty',
                                    order_cost = '$total',
                                    date = '$date'
                                    WHERE order_id = $order_id";
       $res = mysqli_query($conn,$query);
  
       if($res){
           echo "<script>alert('Update Order berhasil')</script>";
       } else {
           echo "<script>alert('Update Order gagal')</script>";
       }
    }

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Orders</title>
    </head>

    <body>
        <form action="update.php?order_id=<?= $order_id ?>" method="post">
        <div class="input">
                    <select name="product_id">
                        <?php while($row = mysqli_fetch_array($result)): ?>
                            <option value="<?= $row['product_id'] ?>"><?= $row['product_id'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="order_qty" placeholder="Quantity" value="<?=  $order_qty_old ?>" required>
                </div>

            <input type="submit" name="btn_update" value="Update">
        </form>
    </body>
    </html>