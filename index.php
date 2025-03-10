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
                            <div class="categories__item set-bg" data-setbg="admin/img/category/<?php echo $resultCat->records[$i]->id ?>/<?php echo $resultCat->records[$i]->id ?>.png">
                                <h5><a href="category.php?catId=<?php echo $resultCat->records[$i]->id ?>"><?php echo $resultCat->records[$i]->name ?></a></h5>
                            </div>
                        </div>
                    <?php } ?>
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
                    <!-- <div class="featured__controls"> -->
                    <!-- <ul> -->
                    <!-- <li class="active" data-filter="*">All</li> -->
                    <?php // for ($i = 0; $i < sizeof($resultCat->records); $i++) { 
                    ?>
                    <!-- <li data-filter=".<?php // echo "data-" . $resultCat->records[$i]->id 
                                            ?>"><?php // echo $resultCat->records[$i]->name 
                                                ?></li> -->
                    <?php // } 
                    ?>
                    <!-- <li class="active" data-filter="*">All</li> -->
                    <!-- <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li> -->
                    <!-- </ul> -->
                    <!-- </div> -->
                </div>
            </div>
            <div class="row featured__filter" id="product-list">
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner mb-5">
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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let page = 1;
        let isLoading = false; // Flag to prevent multiple AJAX calls

        function loadProducts() {
            // Prevent multiple requests at once
            if (isLoading) return;

            isLoading = true; // Set loading flag to true

            $.ajax({
                url: '<?php echo $URL ?>product/readProduct.php', // API to get products
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    page: page,
                    catId: ""
                }),
                success: function(response) {
                    console.log(response.records);

                    if (response.records && response.records.length > 0) {
                        response.records.forEach(product => {
                            console.log(product);
                            const productHTML = `
                            <div class="col-lg-3 col-md-4 col-sm-6 mix data-${product['categoriesId']}">
                                <div class="featured__item">
                                    <form action="admin/action/cat_cookies.php" method="POST">
                                        <a href="shop-details.php?id=${product['id']}" style="width:1px; height: 1px;">
                                        <div class="featured__item__pic set-bg" data-setbg="admin/productimages/${product['skuId']}/${product['skuId']}1.png">
                                        <img src="admin/productimages/${product['skuId']}/${product['skuId']}1.png" alt="" loading="lazy">
                                </div>
                            <div class="featured__item__text">
                                <h6><a href="shop-details.php?id=${product['id']}">${product['productName']}</a></h6>
                                <h5>&#8377;
                                ${product['discount'] > 0 ? `<span style="text-decoration: line-through;">${product['price']}</span>` : `${product['price']}`}
                                 ${product['discount'] > 0 ? `${Math.floor(product['price'] - ((product['price'] * product['discount']) / 100))} <span class="h6 mx-2">${product['discount']}% off</span>` : ''}
                                </h5>
                    <div class="col-12 d-flex justify-content-between">
                            <form action="./admin/action/cat_cookies.php" method="post" class="d-flex col-6" style="margin: 0; padding:0;">
                                    <button type="submit" name="add_to_cart" value="1" class="shopButton col-6">Add to cart</button>
                                    <input type="hidden" name="pid" value="${product['id']}">
                                    <input type="hidden" name="pName" value="${product['productName']}">
                                     <input type="hidden" name="pPrice" value="${product['price']}">
                                    <input type="hidden" name="pSkuId" value="${product['skuId']}">
                                     <input type="hidden" name="pDiscount" value="${product['discount']}">
                                     <input type="hidden" name="pQuantity" value="1">
                                     <input type="hidden" name="pCatId" value="${product['categoriesId']}">
                            </form>
                            <form action="checkout.php" method="post" class="d-flex col-5" style="padding: 0px; margin:0px;">
                                    <button type="submit" class="shopButton col-12">Buy Now</button>
                                    <input type="hidden" name="pid" value="<?php echo $resultCat->records[$i]->id; ?>">
                                    <input type="hidden" name="pName" value="<?php echo $resultCat->records[$i]->productName; ?>">
                                    <input type="hidden" name="pPrice" value="<?php echo $resultCat->records[$i]->price; ?>">
                                    <input type="hidden" name="pSkuId" value="<?php echo $resultCat->records[$i]->skuId; ?>">
                                    <input type="hidden" name="pDiscount" value="<?php echo $resultCat->records[$i]->discount; ?>">
                                    <input type="hidden" name="pQuantity" value="1">
                                    <input type="hidden" name="pCatId" value="<?php echo $resultCat->records[$i]->categoriesId; ?>">
                            </form>
                    </div>
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