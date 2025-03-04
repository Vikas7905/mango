<?php include './includes/header.php' ?>

<body>
    <?php include './includes/navbar.php' ?>
    <?php
    include './constant.php';
    include 'includes/curl_header_home.php';
    $data = array("read" => 'ALL');
    $postData = json_encode($data);
    $url = $URL . 'product/readProduct.php';
    $readCurl = new CurlHome();
    $response = $readCurl->createCurl($url, $postData, 0, 5, 1);
    // print_r($response);
    $result = json_decode($response);
    if (isset($_GET['sort'])) {
        $sort  = $_GET['sort'];
        $data = array("sort" => $sort);
        $postData = json_encode($data);
        $readCurl = new CurlHome();
        $response = $readCurl->createCurl($url, $postData, 0, 5, 1);
        // print_r($response);
        $result = json_decode($response);
    }
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $data = array("search" => $search);
        $postData = json_encode($data);
        $readCurl = new CurlHome();
        $response = $readCurl->createCurl($url, $postData, 0, 5, 1);
        //    print_r($response);
        $result =  json_decode($response);
    }
    // print_r($_COOKIE['user_cart']);
    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                <li><a href="#">Fresh Meat</a></li>
                                <li><a href="#">Vegetables</a></li>
                                <li><a href="#">Fruit & Nut Gifts</a></li>
                                <li><a href="#">Fresh Berries</a></li>
                                <li><a href="#">Ocean Foods</a></li>
                                <li><a href="#">Butter & Eggs</a></li>
                                <li><a href="#">Fastfood</a></li>
                                <li><a href="#">Fresh Onion</a></li>
                                <li><a href="#">Papayaya & Crisps</a></li>
                                <li><a href="#">Oatmeal</a></li>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <!-- <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/product/discount/pd-1.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/product/discount/pd-2.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Vegetables’package</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/product/discount/pd-3.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mixed Fruitss</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/product/discount/pd-4.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/product/discount/pd-5.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/product/discount/pd-6.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <form action="shop-grid.php" method="GET">
                                        <select name="sort" onchange="this.form.submit()">
                                            <option value="default" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'default' ? 'selected' : ''; ?>>Default</option>
                                            <option value="name_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'name_asc' ? 'selected' : ''; ?>>A to Z</option>
                                            <option value="name_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'name_desc' ? 'selected' : ''; ?>>Z to A</option>
                                            <option value="price_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : ''; ?>>Low to High</option>
                                            <option value="price_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : ''; ?>>High to Low</option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if ($result) {
                            for ($i = 0; $i < sizeof($result->records); $i++) { ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <a href="shop-details.php?id=<?php echo $result->records[$i]->id; ?>" style="width: 1px; height:1px;">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="">
                                                <img src="admin/productimages/<?php echo $result->records[$i]->skuId; ?>/<?php echo $result->records[$i]->skuId; ?>1.png" alt="">
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                                    <li>
                                                        <form action="./admin/action/cat_cookies.php" method="post">
                                                            <button type="submit" style="background: transparent; border: none" name="add_to_cart" value="1">
                                                                <a><i class="fa fa-shopping-cart"></i></a>
                                                            </button>
                                                            <input type="hidden" name="pid" value="<?php echo $result->records[$i]->id; ?>">
                                                            <input type="hidden" name="pName" value="<?php echo $result->records[$i]->productName; ?>">
                                                            <input type="hidden" name="pPrice" value="<?php echo $result->records[$i]->price; ?>">
                                                            <input type="hidden" name="pSkuId" value="<?php echo $result->records[$i]->skuId; ?>">
                                                            <input type="hidden" name="pDiscount" value="<?php echo $result->records[$i]->discount; ?>">
                                                            <input type="hidden" name="pQuantity" value="1">
                                                            <input type="hidden" name="pCatId" value="<?php echo $result->records[$i]->categoriesId; ?>">
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><a href="#"><?php echo $result->records[$i]->productName ?></a></h6>
                                                <h5>
                                                    &#8377;
                                                    <?php
                                                    echo ($result->records[$i]->discount > 0)
                                                        ? '<span style="text-decoration: line-through;">' . $result->records[$i]->price . '</span> '
                                                        : ''; // If discount exists, show the original price with strikethrough

                                                    echo ($result->records[$i]->discount > 0)
                                                        ? floor($result->records[$i]->price - (($result->records[$i]->price * $result->records[$i]->discount) / 100)) . ' <span class="h6 mx-2">' . $result->records[$i]->discount . '% off</span>'
                                                        : $result->records[$i]->price; // Show discounted price, else show original price
                                                    ?>
                                                </h5>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php }
                        } else {
                            echo "<div class='col-12 text-center mt-5'>
            <div class='alert alert-info' role='alert'>
                <h4 class='alert-heading'>No Records Found</h4>
                <p>Sorry, we couldn't find any products matching your search criteria. Please try again with different terms.</p>
            </div>
        </div>";
                        } ?>

                    </div>

                        <!-- ************************** -->
                    <!-- Pagination  -->
                    <!-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> -->
                    <!-- ********************* -->
                     
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php include './includes/footer.php' ?>