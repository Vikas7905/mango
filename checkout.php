<?php include './includes/header.php' ?>
<body>
  <?php  include './includes/navbar.php';
//   print_r($_POST);
  ?>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="addressLine1" required>
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="tel" name="mobile" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="number" name="postalCode" required>
                            </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Remember me?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                <?php
                                if (!empty($cart)) {
                                    foreach ($cart as $index => $item) {
                                        // print_r($item);
                                        $productName = $item['productName'];
                                        $pId = $item['pid'];
                                        $price = $item['price'];
                                        $skuId = $item['skuId'];
                                        $catId = $item['catId'];
                                        $productPrice = $item['discountedPrice'];
                                        $quantity = $item['quantity'];
                                        $total = $productPrice * $quantity;
                                        $productImage = "admin/productimages/{$item['skuId']}/{$item['skuId']}1.png"; // Assuming the image path is correct
                                ?>
                                    <li><?php echo $productName ?> <span>&#8377;<?php echo $productPrice ?></span></li>
                                    <?php } }?>
                                    <!-- <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li> -->
                                </ul>
                                <?php
                            $subtotal = 0;
                            foreach ($cart as $item) {
                                $subtotal += $item['discountedPrice'] * $item['quantity'];
                            }
                            $totalAmount = $subtotal; // You can add tax, shipping, etc. if needed
                            ?>
                                <div class="checkout__order__subtotal">Subtotal <span>&#8377;<?php echo $totalAmount ?></span></div>
                                <div class="checkout__order__total">Total <span>&#8377;<?php echo $totalAmount ?></span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Online Payment
                                        <input type="checkbox" id="payment" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
<?php include './includes/footer.php' ?>