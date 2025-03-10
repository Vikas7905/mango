<!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->
<!-- Humberger Begin -->

<style>
        /* Default image size (Laptop/large screens) */
        .responsive-image {
            width: 100%;
        }

        /* For smaller screens (Mobile devices) */
        @media (max-width: 768px) {
            .responsive-image {
                width: 30%; /* Adjust the percentage or use specific px values */
            }
        }

        /* For larger screens (e.g., laptops/desktops) */
        @media (min-width: 769px) {
            .responsive-image {
                width: 50%; /* Adjust as needed */
            }
        }
    </style>
    <?php session_start(); ?>
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/log.png" alt="" style="width: 25%;"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><ahref="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?php
                                                                                    $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];
                                                                                    echo count($cart);
                                                                                    ?></span></a></li>

        </ul>
        <?php
        // Fetch cart data from cookie
        $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];

        $totalDiscountedPrice = 0; // Initialize total discounted price

        if (!empty($cart)) {
            foreach ($cart as $item) {
                // Get the discounted price and quantity for each item
                $productPrice = $item['discountedPrice']; // Discounted price
                $quantity = $item['quantity']; // Quantity of the product

                // Calculate total for this item
                $totalDiscountedPrice += $productPrice * $quantity;
            }

            // Now $totalDiscountedPrice contains the sum of discounted prices for all items in the cart
            echo '<div class="header__cart__price">item: <span>&#8377;' . number_format($totalDiscountedPrice, 2) . '</span></div>';
        } else {
            echo '<div class="header__cart__price">item: <span>&#8377;' . $totalDiscountedPrice . '</span></div>';
        }
        ?>
    </div>
    <div class="humberger__menu__widget">
        <!-- <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                 <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul> 
            </div> -->
        <div class="header__top__right__auth">
            <?php if (isset($_SESSION["name"]) || isset($_COOKIE['name'])): ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <?php
                                                    $fullName = $_COOKIE['name'];
                                                    $name = explode(" ", $fullName);
                                                    echo $name[0];
                                                    ?>

                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="profile.php">My Profile</a>
                        <a class="dropdown-item" href="orders.php">My Orders</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php"><i class="fa fa-user"></i> Login</a>
            <?php endif; ?>
        </div>

    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="./index.php">Home</a></li>
            <li><a href="./shop-grid.php">Shop</a></li>
            <!-- <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Shop Details</a></li>
                        <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./blog-details.php">Blog Details</a></li>
                    </ul>
                </li> -->
            <!-- <li><a href="./blog.php">Blog</a></li> -->
            <li><a href="./contact.php">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <!-- <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div> -->
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> shivammangoshop@gmail</li>
            <li>Free Shipping for all Order of 1000</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> shivammangoshop@gmail.com</li>
                            <li>Free Shipping for all Order of 1000</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <!-- <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div> -->
                        <!-- <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> -->
                        <div class="header__top__right__auth">
                            <?php if (isset($_SESSION["name"]) || isset($_COOKIE['name'])): ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user"></i> <?php
                                                                    $fullName = $_COOKIE['name'];
                                                                    $name = explode(" ", $fullName);
                                                                    echo $name[0];
                                                                    ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="changePassword.php">Change Password</a>
                                        <a class="dropdown-item" href="orders.php">My Orders</a>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <a href="login.php"><i class="fa fa-user"></i> Login</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="./index.php"><img src="img/log.png" alt="" class="responsive-image"></a>
                </div>
            </div>
            <div class="col-lg-5">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./shop-grid.php">Shop</a></li>
                        <!-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.php">Shop Details</a></li>
                                    <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                                    <li><a href="./checkout.php">Check Out</a></li>
                                    <li><a href="./blog-details.php">Blog Details</a></li>
                                </ul>
                            </li> -->
                        <!-- <li><a href="./blog.php">Blog</a></li> -->
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="row justify-content-center header__cart">

                    <div class="header__search">
                        <form action="shop-grid.php" method="get" class="d-flex align-items-center">
                            <input type="text" name="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>" class="form-control search-input">
                            <button type="submit" class="btn btn-outline-secondary search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
            <div class="col-lg-2">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?php
                                                                                                $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];
                                                                                                echo count($cart);
                                                                                                ?></span></a></li>
                    </ul>
                    <?php
                    // Fetch cart data from cookie
                    $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];

                    $totalDiscountedPrice = 0; // Initialize total discounted price

                    if (!empty($cart)) {
                        foreach ($cart as $item) {
                            // Get the discounted price and quantity for each item
                            $productPrice = $item['discountedPrice']; // Discounted price
                            $quantity = $item['quantity']; // Quantity of the product

                            // Calculate total for this item
                            $totalDiscountedPrice += $productPrice * $quantity;
                        }

                        // Now $totalDiscountedPrice contains the sum of discounted prices for all items in the cart
                        echo '<div class="header__cart__price">item: <span>&#8377;' . number_format($totalDiscountedPrice, 2) . '</span></div>';
                    } else {
                        echo '<div class="header__cart__price">item: <span>&#8377;' . $totalDiscountedPrice . '</span></div>';
                    }
                    ?>


                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->