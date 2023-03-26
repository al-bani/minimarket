<?php
include '../server/conn.php';

$id = $_GET['order_id'];
echo $id;
$query = "DELETE FROM orders WHERE order_id = '$id'";
mysqli_query($conn,$query);

header("location: index.php");
?>