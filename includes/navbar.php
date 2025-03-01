<!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->
<!-- Humberger Begin -->
<?php session_start(); ?>
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/log.png" alt="" style="width: 25%;"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span><?php echo isset($_COOKIE['cart']) ? $_COOKIE['cart'] : 0 ?></span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>&#8377; 0</span></div>
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
            <?php echo isset($_SESSION["name"]) ? '<i class="fa fa-user"></i>' . $_SESSION['name'] . '' : '<a href="login.php"><i class="fa fa-user"></i> Login</a>'; ?>

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
            <li><a href="./blog.php">Blog</a></li>
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
                            <li><i class="fa fa-envelope"></i> shivammangoshop@gmial.com</li>
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
                            <?php echo isset($_SESSION["name"]) ? '<i class="fa fa-user"></i> &nbsp;' . $_SESSION['name'] . '' : '<a href="login.php"><i class="fa fa-user"></i> Login</a>'; ?>
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
                    <a href="./index.php"><img src="img/log.png" alt="" style="width: 25%;"></a>
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
                        <li><a href="./blog.php">Blog</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="row justify-content-center header__cart">

                    <div class="header__search">
                        <form action="shop-grid.php" method="get" class="d-flex align-items-center">
                            <input type="text" name="search" placeholder="Search products..." class="form-control search-input">
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
                        <li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo isset($_COOKIE['cart']) ? $_COOKIE['cart'] : 0 ?></span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>&#8377; 0</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->