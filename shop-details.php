<?php include './includes/header.php' ?>

<body>
    <?php include './includes/navbar.php'; ?>

    <?php
    include 'constant.php';
    include_once 'includes/curl_header_home.php';
    // nextpage.php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $id = $_GET['id'];

        $data = array("pid" => $id, "crid" => "", "spid" => "", "sort" => "", "pageSize" => "", "filter" => "", "extra" => "");
        $postdata = json_encode($data);
        $url_id = $URL . "product/readProductById.php";
        $readCurl = new CurlHome();
        $response_all = $readCurl->createCurl($url_id, $postdata, 0, 5, 1);
        // print_r($response_all);
        $resultProduct = json_decode($response_all);

        $cat = array("catId" => $resultProduct->records[0]->categoriesId);
        // print_r($cat);
        $postcat = json_encode($cat);
        $url_cat = $URL . "product/readProduct.php";
        $readCurl = new CurlHome();
        $response_cat = $readCurl->createCurl($url_cat, $postcat, 0, 5, 1);
        // print_r($response_cat);
        $resultCat = json_decode($response_cat);
    }
    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Fruit’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Fruits</a>
                            <span>Fruit 's Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="admin/productimages/<?php echo $resultProduct->records[0]->skuId; ?>/<?php echo $resultProduct->records[0]->skuId; ?>1.png" alt="">
                        </div>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $resultProduct->records[0]->productName ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">&#8377;<?php
                                                                    $originalPrice = $resultProduct->records[0]->price;
                                                                    $discountPercentage = $resultProduct->records[0]->discount;

                                                                    // Calculate discounted price
                                                                    $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);

                                                                    // Show line-through only if there is a discount
                                                                    if ($discountPercentage > 0) {
                                                                        echo '<span style="text-decoration: line-through;">' . $originalPrice . '</span> ';
                                                                    }
                                                                    echo floor($discountedPrice);
                                                                    if ($discountPercentage > 0) {
                                                                        echo '<span class="h6 mx-2">' . $resultProduct->records[0]->discount . '% off</span>';
                                                                    }
                                                                    ?>
                        </div>
                        <p><?php echo $resultProduct->records[0]->description ?></p>
                        <form action="admin/action/cat_cookies.php" method="post">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="pQuantity" value="1" min="1">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="pid" value="<?php echo $resultProduct->records[0]->pid ?>">
                            <input type="hidden" name="pName" value="<?php echo $resultProduct->records[0]->productName; ?>">
                            <input type="hidden" name="pPrice" value="<?php echo $resultProduct->records[0]->price; ?>">
                            <input type="hidden" name="pSkuId" value="<?php echo $resultProduct->records[0]->skuId; ?>">
                            <input type="hidden" name="pCatId" value="<?php echo $resultProduct->records[0]->categoriesId; ?>">
                            <input type="hidden" name="pDiscount" value="<?php echo $resultProduct->records[0]->discount; ?>">

                            <button class="primary-btn btn" name="add_to_cart" value="1">ADD TO CARD</button>
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        </form>
                        <ul>
                            <li><b>Availability</b> <?php if ($resultProduct->records[0]->discount > 0) {
                                                        echo '<span>In Stock</span>';
                                                    } else {
                                                        echo '<span class="text-danger">Out Of Stock</span>';
                                                    }
                                                    ?></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <!-- <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                        suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                        vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                        accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                        pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                        elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                        et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                        vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                        sed sit amet dui. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php for ($i = 0; $i < sizeof($resultCat->records); $i++) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="shop-details.php?id=<?php echo $resultCat->records[$i]->id; ?>" style="width: 1px; height:1px;">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="">
                                    <img src="admin/productimages/<?php echo $resultCat->records[$i]->skuId; ?>/<?php echo $resultCat->records[$i]->skuId; ?>1.png" alt="">
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?php echo $resultCat->records[$i]->productName ?></a></h6>
                                    <h5>
                                        &#8377;
                                        <?php
                                        echo ($resultCat->records[$i]->discount > 0)
                                            ? '<span style="text-decoration: line-through;">' . $resultCat->records[$i]->price . '</span> '
                                            : ''; // If discount exists, show the original price with strikethrough

                                        echo ($resultCat->records[$i]->discount > 0)
                                            ? floor($resultCat->records[$i]->price - (($resultCat->records[$i]->price * $resultCat->records[$i]->discount) / 100)) . ' <span class="h6 mx-2">' . $resultCat->records[$i]->discount . '% off</span>'
                                            : $resultCat->records[$i]->price; // Show discounted price, else show original price
                                        ?>
                                    </h5>
                                    <div class="col-12 d-flex justify-content-between">
                                        <form action="./admin/action/cat_cookies.php" method="post" class="d-flex col-6" style="margin: 0; padding:0;">
                                            <button type="submit" name="add_to_cart" value="1" class="shopButton col-12">Add to cart</button>
                                            <input type="hidden" name="pid" value="<?php echo $resultCat->records[$i]->id; ?>">
                                            <input type="hidden" name="pName" value="<?php echo $resultCat->records[$i]->productName; ?>">
                                            <input type="hidden" name="pPrice" value="<?php echo $resultCat->records[$i]->price; ?>">
                                            <input type="hidden" name="pSkuId" value="<?php echo $resultCat->records[$i]->skuId; ?>">
                                            <input type="hidden" name="pDiscount" value="<?php echo $resultCat->records[$i]->discount; ?>">
                                            <input type="hidden" name="pQuantity" value="1">
                                            <input type="hidden" name="pCatId" value="<?php echo $resultCat->records[$i]->categoriesId; ?>">
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
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <!-- <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
    <?php include './includes/footer.php' ?>