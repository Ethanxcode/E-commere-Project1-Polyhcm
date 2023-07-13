<?php
ob_start();
include './lib/session.php';
Session::init();
?>
<?php
include_once  './lib/database.php';
include_once './helpers/format.php';
spl_autoload_register(function ($className) {
    include_once './classes/' . $className . '.php';
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$cs = new customer();
$us = new user();
$cat = new category();
$product = new product();
$brand = new brand();
?>



<?php
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    // Tiếp tục đăng nhập
} else {
    // Session::destroy();
    // header('Location:login.php');
}
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPShop</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- app css -->
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/app.css">
    <!-- bs5 -->

</head>

<body>

    <!-- header -->
    <header>
        <!-- mobile menu -->
        <div class="mobile-menu bg-second">
            <a href="./index.php" class="mb-logo">TPShop</a>
            <span class="mb-menu-toggle" id="mb-menu-toggle">
                <i class='bx bx-menu'></i>
            </span>
        </div>
        <!-- end mobile menu -->
        <!-- main header -->
        <div class="header-wrapper" id="header-wrapper">
            <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
                <i class='bx bx-x'></i>
            </span>
            <!-- top header -->
            <div class="bg-second">
                <div class="top-header container">
                    <ul class="devided">
                        <li>
                            <a href="#">+840123456789</a>
                        </li>
                        <li>
                            <a href="#">TPshop@mail.com</a>
                        </li>
                    </ul>
                    <ul class="devided">
                        <li class="dropdown">
                            <a href="">USD</a>
                            <i class='bx bxs-chevron-down'></i>
                            <ul class="dropdown-content">
                                <li><a href="#">VND</a></li>
                                <li><a href="#">JPY</a></li>
                                <li><a href="#">EUR</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="">ENGLISH</a>
                            <i class='bx bxs-chevron-down'></i>
                            <ul class="dropdown-content">
                                <li><a href="#">VIETNAMESE</a></li>
                                <li><a href="#">JAPANESE</a></li>
                                <li><a href="#">FRENCH</a></li>
                                <li><a href="#">SPANISH</a></li>
                            </ul>
                        </li>

                        <?php
                        if (isset($_GET['customerid'])) {
                            // $delCart = $ct->dell_data_cart();
                            Session::destroy();
                        }
                        ?>
                        <?php
                        $login_cheack = Session::get('customer_login');
                        if ($login_cheack == false) {
                            echo "<li><a href='./login.php'>Đăng nhập</a></li>";
                        } else {
                            // echo "đã đăng nhập";
                            echo '<li><a href="">Hi  ' . Session::get('customer_name') . '</a></li>';
                            echo '<li><a href="?customerid=' . Session::get('customer_id') . '">Đăng xuất</a></li>';
                        }
                        ?>
                        <!-- <li><a href="./login.php">Đăng Nhập</a></li> -->
                    </ul>
                </div>
            </div>
            <!-- end top header -->
            <!-- mid header -->
            <div class="bg-main">
                <div class="mid-header container">
                    <a href="index.php" class="logo">TPShop</a>
                    <form action="./products.php" method="post">
                        <div class="search">
                            <input type="text" placeholder="Search" name="tukhoa">

                            <button class="d-flex" style="border: none; background-color: #f5f5f5;" name="search_product" type="submit"><i class='bx bx-search-alt'></i></button>
                        </div>
                    </form>
                    <ul class="user-menu">
                        <?php
                        $login_cheack = Session::get('customer_name');
                        if (isset($login_cheack) && $login_cheack == null) {
                        } else {
                        ?>
                            <li><a href="./compare.php"><img style="width:40px ;" src="https://cdn0.iconfinder.com/data/icons/scenarium-vol-11/128/039_reviews_product_quality_compare-512.png" alt=""></a></li>
                        <?php } ?>
                        <?php
                        $login_cheack = Session::get('customer_name');
                        if (isset($login_cheack) && $login_cheack == null) {
                        } else {
                        ?>
                            <li><a href="./order-detail.php"><img style="width: 40px;" src="https://cdn0.iconfinder.com/data/icons/ecommerce-online-shopping-1/20/outline_ecommerce-basket-512.png" alt=""></a></li>
                        <?php } ?>
                        <?php
                        $login_cheack = Session::get('customer_name');
                        if (isset($login_cheack) && $login_cheack == null) {
                        } else {
                        ?>
                            <li><a href="./wishlist.php"><img style="width: 40px;" src="https://cdn0.iconfinder.com/data/icons/ecommerce-online-shopping-1/20/outline_ecommerce-wishlist-512.png" alt=""></a></li>
                        <?php } ?>
                        <li><a href="#"><img style="width: 40px;" src="https://cdn1.iconfinder.com/data/icons/time-notification-1/24/alarm-bell-ring-remind-notice-512.png" alt=""></a></li>
                        <?php
                        $login_cheack = Session::get('customer_name');
                        if (isset($login_cheack) && $login_cheack == null) {
                        } else {
                        ?>
                            <li><a href="./profile.php"><img style="width:40px ;" src="https://cdn0.iconfinder.com/data/icons/eon-social-media-contact-info-2/32/user_people_person_users_man-512.png" alt=""></a></li>
                        <?php } ?>

                        <li><a href="./cart.php"><img style="width:40px ;" src="https://cdn3.iconfinder.com/data/icons/webina-seo-development-and-marketing/128/seo_web_3-76-512.png" alt=""></a></li>
                    </ul>
                </div>
            </div>
            <!-- end mid header -->
            <!-- bottom header -->
            <div class="bg-second">
                <div class="bottom-header container">
                    <ul class="main-menu">
                        <li><a href="./index.php">home</a></li>
                        <!-- mega menu -->
                        <li class="mega-dropdown">
                            <a href="./products.php">Shop<i class='bx bxs-chevron-down'></i></a>
                            <div class="mega-content">
                                <div class="row">
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Thương hiệu</h3>
                                            <ul>
                                                <?php
                                                $show_brand = $brand->show_brand();
                                                if ($show_brand) {
                                                    foreach ($show_brand as $show_brand) {
                                                ?>
                                                        <li><a href="#"><?php echo $show_brand['brandName'];  ?></a></li>
                                                <?php
                                                    }
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Danh mucj</h3>
                                            <ul>
                                                <?php
                                                $show_cate = $cat->show_category();
                                                if ($show_cate) {
                                                    foreach ($show_cate as $show_cate) {
                                                ?>
                                                        <li><a href="#"><?php echo $show_cate['catName'];  ?></a></li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Thương hiệu</h3>
                                            <ul>
                                                <?php
                                                $show_brand = $brand->show_brand();
                                                if ($show_brand) {
                                                    foreach ($show_brand as $show_brand) {
                                                ?>
                                                        <li><a href="#"><?php echo $show_brand['brandName'];  ?></a></li>
                                                <?php
                                                    }
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Kiểu tai nghe</h3>
                                            <ul>
                                                <?php
                                                $show_cate = $cat->show_category();
                                                if ($show_cate) {
                                                    foreach ($show_cate as $show_cate) {
                                                ?>
                                                        <li><a href="#"><?php echo $show_cate['catName'];  ?></a></li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row img-row">
                                    <div class="col-3">
                                        <div class="box">
                                            <img src="./images/iPad_Pro_12-9_Cellular_Silver-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="box">
                                            <img src="./images/JBL_TUNE220TWS_ProductImage_Pink_ChargingCaseOpen.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="box">
                                            <img src="./images/JBL_JR 310BT_Product Image_Hero_Skyblue.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="box">
                                            <img src="./images/JBLHorizon_001_dvHAMaster.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- end mega menu -->
                        <li><a href="#">blog</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- end bottom header -->
        </div>
        <!-- end main header -->
    </header>