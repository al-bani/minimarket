<?php include("../server/conn.php");

if (isset($_POST['btn-search'])) {
    $search = $_POST['txt-search'];
    $query = "SELECT * FROM orders WHERE order_id LIKE '%$search%'";
} else {
    $query = "SELECT * FROM orders";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
</head>

<body>
    <div class="container">
        <div class="top">
            <h3>Manage Orders</h3>
        </div>
        <div class="search">
            <form method="POST">
                <input type="text" class="textbox" name="txt-search" placeholder="Search by Name" required>
                <input type="submit" class="submit" name="btn-search" value="Search">
            </form>
            <input type="submit" onclick="location.href='../orders/';" value="refresh">
        </div>
        <div class="box">
            <input type="submit" value="Tambah Order" onclick="location.href='create.php'">
            <table class="table-border">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Admin ID</th>
                        <th>Product ID</th>
                        <th>Order Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><?= $row['order_id'] ?></td>
                            <td><?= $row['admin_id'] ?></td>
                            <td><?= $row['product_id'] ?></td>
                            <td><?= $row['order_qty'] ?></td>
                            <td><?= $row['order_cost'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td>
                                <div class="alert">
                                    <input type="submit" class="btn-update" value="Edit" onclick="location.href='update.php?order_id=<?= $row['order_id'] ?>';">
                                    <input type="submit" class="btn-delete" value="delete"
                                    onclick="if (confirm ('Data ini akan di hapus?') == true) {
                                                location.href='delete.php?order_id=<?= $row['order_id'] ?>'
                                            } else{
                                                 return false;
                                    }">       
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>