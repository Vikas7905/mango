<?php include './includes/header.php' ?>
<body>
<?php include './includes/navbar.php'; 
 include 'includes/header.php'; 
 include "constant.php";
 if(isset($_GET['catId'])){
    $catId =  $_GET['catId'];
    include_once 'includes/curl_header_home.php';
    $cat = array("catId"=>$catId);
    // print_r($cat);
    $postcat = json_encode($cat);
    $url_cat = $URL . "product/readProduct.php";
    $readCurl = new CurlHome();
    $response_cat = $readCurl->createCurl($url_cat, $postcat, 0, 5, 1);
    // print_r($response_cat);
    $resultCat = json_decode($response_cat);
 }
 ?>
<div class="container">
   <div class="row">
                <?php for($i=0; $i<sizeof($resultCat->records); $i++){ ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="shop-details.php?id=<?php echo $resultCat->records[$i]->id; ?>" style="width: 0.1px; height:0.1px">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="">
                            <img src="admin/productimages/<?php echo $resultCat->records[$i]->skuId; ?>/<?php echo $resultCat->records[$i]->skuId; ?>1.png" alt="">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo $resultCat->records[$i]->productName ?></a></h6>
                            <h5>&#8377; <?php
                                                $originalPrice = $resultCat->records[$i]->price;
                                                $discountPercentage = $resultCat->records[$i]->discount;
                                                
                                                // Calculate discounted price
                                                $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);

                                                // Show line-through only if there is a discount
                                                if ($discountPercentage > 0) {
                                                    echo '<span style="text-decoration: line-through;">' . $originalPrice . '</span> ';
                                                }
                                                echo floor($discountedPrice);
                                                ?></h5>
                        </div>
                    </div>
                    </a>
                </div>
                <?php } ?>
   </div>
   </div>





<?php include './includes/footer.php' ?>
</body>