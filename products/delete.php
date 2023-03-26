<?php
include '../server/conn.php';

$id = $_GET['product_id'];

$query = "DELETE FROM products WHERE product_id = '$id'";
mysqli_query($conn,$query);

header("location: index.php");
?>