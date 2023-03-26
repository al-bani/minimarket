<?php include('../server/conn.php');

    if(!isset($_SESSION['status'])){
        header('location: login.php');
        exit;
    }

    $product_id = $_GET['product_id'];

    $product_id_check = mysqli_query($conn, "SELECT product_id FROM products");

    while($row = mysqli_fetch_row($product_id_check)){
        foreach($row as $element => $value){
            if(!is_numeric($product_id) || $product_id == NULL){
                $status_product_id = TRUE;
            }

            if($value == $product_id){
                $status_product_id = TRUE;
            }
        }
    }

    if($status_product_id != TRUE){
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

    if(isset($_POST['btn_update'])){  
        $product_name = $_POST['Name'];
        $product_price = $_POST['price'];
        $product_desc = $_POST['desc'];
        $product_stok = $_POST['stok'];
        $product_photo = $_POST['photo'];

        $query = "UPDATE products SET product_name = '$product_name',
                                        product_price = '$product_price',
                                        product_desc = '$product_desc',
                                        product_stok = '$product_stok',
                                        product_photo = '$product_photo'
                                        WHERE product_id = $product_id";

        $res = mysqli_query($conn,$query);
  
        if($res){
            echo "<script>alert('Update Product berhasil')</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('Update Product gagal')</script>";
        }
        
    }
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
        <form action="update.php?product_id=<?= $product_id ?>" method="post">
            <input type="text" name="Name" placeholder="Name" value="<?= $product_name_old ?>">
            <input type="text" name="price" placeholder="price" value="<?= $product_price_old ?>">
            <input type="text" name="desc" placeholder="desc" value="<?= $product_desc_old ?>">
            <input type="text" name="stok" placeholder="stok" value="<?= $product_stok_old ?>">
            <input type="text" name="photo" placeholder="photo" value="<?= $product_photo_old ?>">

            <input type="submit" name="btn_update" value="Update">
        </form>


    </body>

    </html>