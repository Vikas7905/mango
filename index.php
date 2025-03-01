<?php include './includes/header.php' ?>

<body>
    <!-- Page Preloder -->

    <?php include './includes/navbar.php' ?>

    <?php include 'includes/header.php';
    include "constant.php";
    error_reporting(0);
    include_once 'includes/curl_header_home.php';
    $decoded = isset($_SESSION['decoded']) ? $_SESSION['decoded'] : "";
    include_once 'includes/curl_header_home.php';
    $data = array("crid" => $url_param_type, "spid" => $url_sub_param_type, "pid" => "", "filter" => $filter, "pageSize" => $pageSize, "sort" => "", "pincode" => "$pincode", "extra" => "");
    $postdata = json_encode($data);
    // echo "**********". $_POST["sorting"];
    // print_r($data);
    $url_all = $URL . "product/readProductById.php";
    $url_cat = $URL . "category/readCategory.php";
    $readCurl = new CurlHome();
    $response_all = $readCurl->createCurl($url_all, $postdata, 0, 5, 1);
    // print_r($response_all);
    $response_cat = $readCurl->createCurl($url_cat, null, 0, 5, 1);
    //print_r($response_cat);
    $resultcat = json_decode($response_cat);
    $resultProduct = json_decode($response_all);
    if (isset($_GET['filter'])) {
        $data = array(
            "crid" => "",
            "spid" => "",
            "pid" => "",
            "filter" => $_GET['filter'],
            "pageSize" => "",
            "sort" => "",
            "extra" => "",
            "pincode" => ""
        );
        $postdata = json_encode($data);
        $url_all = $URL . "product/readProductById.php";
        $readCurl = new CurlHome();
        $response_all = $readCurl->createCurl($url_all, $postdata, 0, 5, 1);

        //   print_r($response_all);
        $resultProduct = json_decode($response_all);
        //$resultcat = json_decode($response_cat);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sorts'])) {
        $condition = $_POST['sorts'];
        $data = array("crid" => "", "spid" => "", "pid" => "", "filter" => (isset($_GET['filter']) ? $_GET['filter'] : ""), "pageSize" => $pageSize, "sort" => $_POST['sorts'], "extra" => "");
        $postdata = json_encode($data);
        $url_all = $URL . "product/readProductById.php";
        $readCurl = new CurlHome();
        $response_all = $readCurl->createCurl($url_all, $postdata, 0, 5, 1);
        // echo "--sort";
        //   print_r($response_all);
        $resultProduct = json_decode($response_all);
        $resultcat = json_decode($response_cat);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $data = array("crid" => "", "spid" => "", "pid" => "", "filter" => "", "pageSize" => "", "sort" => "", "extra" => $_POST['search']);
        $postdata = json_encode($data);
        //print_r($postdata);
        $url_all_x = $URL . "product/readProductById.php";
        $readCurl = new CurlHome();
        $response_all = $readCurl->createCurl($url_all_x, $postdata, 0, 5, 1);
        //print_r($response_all);
        $resultProduct = json_decode($response_all);
    }

    $url_param_type = isset($_GET['crid']) ? $_GET['crid'] : "";
    $url_sub_param_type = isset($_GET['spid']) ? $_GET['spid'] : "";
    $filter = isset($_GET['filter']) ? $_GET['filter'] : "";
    $pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : "";
    $sorts = isset($_POST['sorts']) ? $_POST['sorts'] : "";


    // Read Pincode
    $pincode_url = $URL . "user/read_user_pincode.php";
    $datapincode = ($decoded->data->email != "") ? array("email" => $decoded->data->email) : array("email" => "");
    //print_r($datapincode);
    $postdatapincode = json_encode($datapincode);
    $readCurlpincode = new CurlHome();
    $response_pincode = $readCurlpincode->createCurl($pincode_url, $postdatapincode, 0, 5, 1);
    //print_r($response_pincode); 
    $resultpincode = json_decode($response_pincode);
    //echo "*************************";
    // print_r($resultpincode);
    // echo isset($_COOKIE['pincode']);
    $pincode = (isset($_COOKIE['pincode']) ? ($_COOKIE['pincode']) : ($resultpincode->records[0]->pincode != "" ? $pincode = $resultpincode->records[0]->pincode : 0));


    // Read All Product from here

    // // Read all Product
    // include_once 'includes/curl_header_home.php';
    // $data = array("crid" => $url_param_type, "spid" => $url_sub_param_type, "pid" => "", "filter" => $filter, "pageSize" => $pageSize, "sort" => "", "pincode" => "$pincode", "extra" => "");
    // $postdata = json_encode($data);
    // // echo "**********". $_POST["sorting"];
    // //print_r($data);
    // $url_all = $URL . "product/readProductById.php";
    // $url_cat = $URL . "category/readCategory.php";
    // $readCurl = new CurlHome();
    // $response_all = $readCurl->createCurl($url_all, $postdata, 0, 5, 1);
    // //print_r($response_all);
    // $response_cat = $readCurl->createCurl($url_cat, null, 0, 5, 1);
    // //print_r($response_cat);
    // $resultcat = json_decode($response_cat);
    // $resultProduct = json_decode($response_all);



    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filter'])) {

        $filter = $_GET['filter'];
        $data = array("crid" => "", "spid" => "", "pid" => "", "filter" => $filter, "pageSize" => $pageSize, "sort" => $sorts, "extra" => "");
        $postdata = json_encode($data);

        $url_all = $URL . "product/readProductById.php";
        $readCurl = new CurlHome();

        $response_all = $readCurl->createCurl($url_all, $postdata, 0, 5, 1);
        // echo "---filter"; 
        // print_r($response_all);
        $resultProduct = json_decode($response_all);
    }
    $data = array("catId" => "");
    $dataCat = array();
    $postdata = json_encode($data);
    $postdataCat = json_encode($dataCat);

    $url_all = $URL . "product/readProduct.php";
    $url_Cat = $URL . "category/readCategory.php";
    $readCurl = new CurlHome();

    $response_all = $readCurl->createCurl($url_all, $postdata, 0, 5, 1);
    $response_Cat = $readCurl->createCurl($url_Cat, $postdataCat, 0, 5, 1);
    // echo "---filter"; 
    // print_r($response_all);
    //   echo "************<br>";
    //   print_r($response_Cat);
    $resultProduct = json_decode($response_all);
    $resultCat = json_decode($response_Cat);
    ?>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php for ($i = 0; $i < sizeof($resultCat->records); $i++) { ?>
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg">
                                <h5><a href="category.php?catId=<?php echo $resultCat->records[$i]->id ?>"><?php echo $resultCat->records[$i]->name ?></a></h5>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg">
                            <h5><a href="#">Fresh Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-2.jpg">
                            <h5><a href="#">Dried Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-3.jpg">
                            <h5><a href="#">Vegetables</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-4.jpg">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <?php for ($i = 0; $i < sizeof($resultCat->records); $i++) { ?>
                                <li data-filter=".<?php echo "data". $resultCat->records[$i]->id ?>"><?php echo $resultCat->records[$i]->name ?></li>
                            <?php } ?>
                            <!-- <li class="active" data-filter="*">All</li> -->
                            <!-- <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter" id="product-list">
                <!-- <div id=""></div> -->
                <!-- <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-2.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fresh-meat">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-3.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood oranges">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-4.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-5.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-6.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-7.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
                    <div class="featured__item">
                            <a href="shop-details.php">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-8.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </a>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
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
        </div>
    </section>
    <!-- Latest Product Section End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let page = 1;
        let isLoading = false; // Flag to prevent multiple AJAX calls

        function loadProducts() {
            // Prevent multiple requests at once
            if (isLoading) return;

            isLoading = true; // Set loading flag to true

            $.ajax({
                url: '<?php echo $URL?>product/readProduct.php', // API to get products
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    page: page,
                    catId: ""
                }),
                success: function(response) {
                    console.log(response);

                    if (response.records && response.records.length > 0) {
                        response.records.forEach(product => {
                            const productHTML = `
                            <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo 'data'?>${product['categoriesId']}">
                                <div class="featured__item">
                                    <!-- Wrap the cart icon in a form -->
                                    <form action="admin/action/cat_cookies.php" method="POST">
                                        <a href="shop-details.php?id=${product['id']}" style="width:1px; height: 1px;">
                                            <div class="featured__item__pic set-bg" data-setbg="admin/productimages/${product['skuId']}/${product['skuId']}1.png">
                                                <img src="admin/productimages/${product['skuId']}/${product['skuId']}1.png" alt="">
                                                <ul class="featured__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li>
                                                        <button type="submit" style="background: transparent; border: none" name="add_to_cart" value="1">
                                                            <a><i class="fa fa-shopping-cart"></i></a>
                                                        </button>
                                                        <input type="hidden" name="product_id" value="${product['id']}">
                                                        <input type="hidden" name="product_name" value="${product['productName']}">
                                                        <input type="hidden" name="product_price" value="${product['price']}">
                                                        <input type="hidden" name="product_sku" value="${product['skuId']}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="featured__item__text">
                                                <h6><a href="#">${product['productName']}</a></h6>
                                                <h5>&#8377;
                                                    ${product['discount'] > 0 ? `<span style="text-decoration: line-through;">${product['price']}</span>` : `${product['price']}`}
                                                    ${product['discount'] > 0 ? `${Math.floor(product['price'] - ((product['price'] * product['discount'])/100))} <span class="h6 mx-2">${product['discount']}% off</span>` : ''}
                                                </h5>
                                            </div>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        `;
                            $('#product-list').append(productHTML); // Append new products to the list
                        });
                        page++; // Increment page number for next load
                    } else {
                        $(window).off('scroll'); // Disable infinite scroll if no products
                    }
                    isLoading = false; // Set loading flag to false after request is done
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                    isLoading = false; // Reset the loading flag in case of error
                }
            });
        }

        // Load initial products when the page loads
        $(document).ready(function() {
            loadProducts();

            // Infinite Scroll: Load more products when user scrolls
            $(window).scroll(function() {
                // Check if user is near bottom of the page
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    loadProducts(); // Load more products
                }
            });
        });
    </script>


    <?php include './includes/footer.php' ?>