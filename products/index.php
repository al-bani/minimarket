<?php include("../server/conn.php");

if (!isset($_SESSION['status'])) {
    header('location: ../login.php');
    exit;
}

if (isset($_POST['btn-search'])) {
    $search = $_POST['txt-search'];
    $query = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
} else {
    $query = "SELECT * FROM products";
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://example.com/fontawesome/v6.4.0/js/fontawesome.js" data-auto-replace-svg="nest"></script>
    <script src="https://example.com/fontawesome/v6.4.0/js/solid.js"></script>
    <script src="https://example.com/fontawesome/v6.4.0/js/brands.js"></script>
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
    <link rel="icon" href="../img/logo/logo.png" type="image/icon type">
    <title>Manage Products</title>
</head>

<body>
    <!-- NAVBAR -->
    <header>
        <img src="../img/logo/logo.png" alt="logo" />
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


    <!-- Search -->
    <div class="conn">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refresh -->
            <button type="button" class="babi" onclick="location.href='../products/';">
                <span class="babi__text">Refresh</span>
                <span class="babi__icon">
                    <ion-icon name="refresh-outline"></ion-icon>
                </span>
            </button>

            <!-- Insert Product  -->
            <div class="insert_action">
                <button type="button" class="babi" onclick="location.href='create.php';">
                    <span class="babi__text">Insert Product</span>
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
                    <th>Product ID</th>
                    <th>Product Photo</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Product Stock</th>
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
                            <a href="update.php?product_id=<?= $row['product_id'] ?>" class="edit">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <a onclick="if (confirm ('Data ini akan di hapus?') == true) {
                                                location.href='delete.php?product_id=<?= $row['product_id'] ?>'
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