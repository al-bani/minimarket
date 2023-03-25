<?php 

include("../server/conn.php");

if(isset($_POST['btn_update'])){  
$order_id = $_POST['order_id'];
$admin_id = $_POST['admin_id'];
$product_id = $_POST['product_id'];
$order_qty = $_POST['order_qty'];
$order_cost = $_POST['order_cost'];


$sql = mysqli_query($conn,"UPDATE orders SET 'admin_id' = '$admin_id',
                                              'product_id' = '$product_id',
                                              'order_qty' = '$order_qty',
                                              'order_cost' = '$order_cost',
                                              WHERE 'order_id' = '$order_id'");
}
?>
<?php

$order_id = $_GET['order_id'];
    $query = mysqli_query($conn, "SELECT * FROM orders where order_id='$order_id'");
    while ($row = mysqli_fetch_array($query)) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EDIT Orders</title>
    </head>

    <body>
        <form action="update-orders.php" method="post">
            <input type="text" name="id" placeholder="id" value="<?php echo $row['order_id'] ?>">
            <input type="text" name="admin_id" placeholder="admin_id" value="<?php echo $row['admin_id'] ?>">
            <input type="text" name="product_id" placeholder="product_id" value="<?php echo $row['product_id'] ?>"> 
            <input type="text" name="order_qty" placeholder="order_qty" value="<?php echo $row['order_qty'] ?>">
            <input type="text" name="order_cost" placeholder="order_cost" value="<?php echo $row['order_cost'] ?>">

            <input type="submit" name="btn_update" value="Update">

        </form>


    </body>

    </html>



<?php
}
?>