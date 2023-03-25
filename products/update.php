<?php 

include('../server/conn.php');

if(isset($_POST['btn_update'])){  
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_desc = $_POST['product_desc'];
$product_stok = $_POST['product_stok'];
$product_photo = $_POST['product_photo'];


$sql = mysqli_query($conn,"UPDATE products SET 'product_name' = '$product_name',
                                               'product_price' = '$product_price',
                                               'product_desc' = '$product_desc',
                                               'product_stok' = '$product_stok',
                                               'product_photo' = '$product_photo'
                                               WHERE 'product_id' = '$product_id'");
}
?>

<?php

$product_id = $_GET['product_id'];

$query = mysqli_query($conn, "SELECT * FROM products where product_id='$product_id'");

while ($row = mysqli_fetch_array($query)) {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EDIT Product</title>
    </head>

    <body>
        <form action="update.php" method="post">
            <input type="text" name="Name" placeholder="Name" value="<?php echo $row['product_name'] ?>">
            <input type="text" name="price" placeholder="price" value="<?php echo $row['product_price'] ?>">
            <input type="text" name="desc" placeholder="desc" value="<?php echo $row['product_desc'] ?>">
            <input type="text" name="stok" placeholder="stok" value="<?php echo $row['product_stok'] ?>">
            <input type="text" name="photo" placeholder="photo" value="<?php echo $row['product_photo'] ?>">

            <input type="submit" name="btn_update" value="Update">
        </form>


    </body>

    </html>
<?php
}
?>