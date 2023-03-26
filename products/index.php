<?php include("../server/conn.php");

if (isset($_POST['btn-search'])) {
    $search = $_POST['txt-search'];
    $query = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
} else {
    $query = "SELECT * FROM products";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
</head>

<body>
    <div class="container">
        <div class="top">
            <h3>Manage products</h3>
        </div>
        <div class="search">
            <form method="POST">
                <input type="text" class="textbox" name="txt-search" placeholder="Search by Name" required>
                <input type="submit" class="submit" name="btn-search" value="Search">
            </form>
        </div>
        <div class="box">
            <input type="submit" value="Tambah Product" onclick="location.href='create.php'">
            <table class="table-border">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Photo Product</th>
                        <th>Nama Product</th>
                        <th>Harga Product</th>
                        <th>Product Deskripsi</th>
                        <th>Product Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><?= $row['product_id'] ?></td>
                            <td><img src="<?= $row['product_photo'] ?>" class="img"></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['product_price'] ?></td>
                            <td><?= $row['product_desc'] ?></td>
                            <td><?= $row['product_stok'] ?></td>
                            <td>
                                <input type="submit" class="btn-update" value="Edit" onclick="location.href='update.php?product_id=<?= $row['product_id'] ?>';">
                                <span class="submitbtn" onclick="return confirm ('Data ini akan di hapus?')">
                                    <input type="submit" class="btn-delete" value="delete" onclick="location.href='delete.php?product_id=<?= $row['product_id'] ?>';">
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>