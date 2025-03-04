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
                                    <a href="shop-details.php?id=<?php echo $resultCat->records[$i]->id; ?>" style="width: 1px; height:1px;">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="">
                                                <img src="admin/productimages/<?php echo $resultCat->records[$i]->skuId; ?>/<?php echo $resultCat->records[$i]->skuId; ?>1.png" alt="">
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                                    <li>  <form action="./admin/action/cat_cookies.php" method="post">
                                                        <button type="submit" style="background: transparent; border: none" name="add_to_cart" value="1">
                                                        <a><i class="fa fa-shopping-cart"></i></a>
                                                        </button>
                                                        <input type="hidden" name="pid" value="<?php echo $resultCat->records[$i]->id; ?>">
                                                        <input type="hidden" name="pName" value="<?php echo $resultCat->records[$i]->productName; ?>">
                                                        <input type="hidden" name="pPrice" value="<?php echo $resultCat->records[$i]->price; ?>">
                                                        <input type="hidden" name="pSkuId" value="<?php echo $resultCat->records[$i]->skuId; ?>">
                                                        <input type="hidden" name="pDiscount" value="<?php echo $resultCat->records[$i]->discount; ?>">
                                                        <input type="hidden" name="pQuantity" value="1">
                                                        <input type="hidden" name="pCatId" value="<?php echo $resultCat->records[$i]->categoriesId; ?>">
                                                        </form>
                                                    </li>
                                                </ul>
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

                                            </div>
                                        </div>
                                    </a>
                                </div>
                <?php } ?>
   </div>
   </div>





<?php include './includes/footer.php' ?>
</body>