<?php include('../server/conn.php');

    if(!isset($_SESSION['status'])){
         header('location: ../index.php');
    }
    
    if(isset($_POST['btn_submit'])){
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
            <h3>Input Product</h3>
        </div>
        <div class="box">
            <form method="POST" action="create.php">
                <div class="input">
                    <input type="text" class="Textbox" name="product_name" placeholder="Product Name" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="product_price" placeholder="Product Price" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="product_desc" placeholder="Product Description" required>
                </div>
                <div class="input">
                    <input type="number" class="Textbox" name="product_stok" min="1" placeholder="Stock" required>
                </div>
                <div class="input">
                    <input type="text" class="Textbox" name="product_photo" placeholder="URL Image" required>
                </div>
                <br/>
                <div class="Submit">
                    <input type="submit" class="button-green" name="btn_submit" value="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>