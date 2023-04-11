<?php include("../server/conn.php");

if (!isset($_SESSION['status'])) {
    header('location: ../login.php');
    exit;
}

if (isset($_POST['btn-search'])) {
    $search = $_POST['txt-search'];
    $query = "SELECT * FROM orders WHERE order_id LIKE '%$search%'";
} else {
    $query = "SELECT * FROM orders";
}

$result = mysqli_query($conn, $query);

if (isset($_GET['logout'])) {
    if (isset($_SESSION['status'])) {
        unset($_SESSION['status']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone']);
        unset($_SESSION['photo']);
        unset($_SESSION['admin_id']);
        echo "<script>alert('Logout Berhasil')</script>";
        echo "<script>window.location.href='login.php'</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="icon" href="../img/logo/logo.png" type="image/icon type">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
        function changeFunc() {
            var selectBox = document.getElementById("selectbox");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            if (selectedValue == 1) {
                location.href = '../update-profile.php';
            } else if (selectedValue == 2) {
                location.href = '../dashboard.php?logout=success';
            }
        }
    </script>
    <title>Manage Orders</title>
</head>
<!-- NAVBAR -->
<header>
    <img src="../img/logo/logo.png" alt="logo">
    <nav>
        <div class="nav__links">
            <ul>
                <li><a href="../about.html"><button>About</button></a></li>
                <div class="select">
                    <select class="select-header" id="selectbox" onchange="changeFunc();">
                        <option hidden Selected><?= $_SESSION['name'] ?></option>
                        <option value="1">My Account</option>
                        <option value="2">Logout</option>
                    </select>
                </div>
            </ul>
        </div>
    </nav>
</header>

<!-- content -->

<!-- Back -->
<div class="back__button">
    <a href="../dashboard.php">
        <ion-icon name="chevron-back"></ion-icon>
    </a>
</div>


<div class="conn">
    <!-- Search -->
    <div class="action_wrap">
        <div class="cari">
            <div class="ss">
                <div class="search_wrap search_wrap_1">
                    <div class="search_box">
                        <form method="POST">
                            <input type="text" class="input" name="txt-search" placeholder="search...">
                            <div class="btn btn_common">
                                <button class="btn btn_common" name="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Refresh -->
            <button type="button" class="babi" onclick="location.href='../orders/';">
                <span class="babi__text">Refresh</span>
                <span class="babi__icon">
                    <ion-icon name="refresh-outline"></ion-icon>
                </span>
            </button>

            <!-- Insert Product  -->
            <div class="insert_action" onclick="location.href='create.php';">
                <button type="button" class="babi" onclick="location.href='create.php';">
                    <span class="babi__text" onclick="location.href='create.php';">Insert Order</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="salman">
    <table class="heavyTable">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Admin Id</th>
                <th>Product ID</th>
                <th>Order Quantity</th>
                <th>Order Cost</th>
                <th>Date </th>
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
                        <a href="update.php?order_id=<?= $row['order_id'] ?>" class="edit">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a onclick="if (confirm ('Data ini akan di hapus?') == true) {
                                                location.href='delete.php?order_id=<?= $row['order_id'] ?>'
                                            } else{
                                                 return false;
                                    }" class="delete">
                            <ion-icon name="trash-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


</body>

</html>