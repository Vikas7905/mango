<?php include './includes/header.php' ?>

<body>
    <?php include './includes/navbar.php' ?>
    <?php
if(isset($_COOKIE["user_cart"])) {
    echo "User Cookie Value: " . $_COOKIE["user_cart"];
} else {
    echo "Cookie is not set!";
}
?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <?php


    // update cart code here

    // Fetch cart data from cookie
    //    $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];

    //     // Check if form is submitted to update the cart
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {
    //         foreach ($_POST['quantity'] as $index => $quantity) {
    //             if (isset($cart[$index])) {
    //                 // Update the quantity in the cart
    //                 $cart[$index]['quantity'] = max(1, (int)$quantity); // Ensure the quantity is at least 1
    //             }
    //         }

    //         // Update the cookie with the new cart
    //         setcookie('user_cart', json_encode($cart), time() + (86400 * 30), "/");
    //     }
    // print_r($_COOKIE['user_cart']);
    ?>

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <!-- Form to update the cart -->

                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
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
                                        <tr>
                                            <form action="admin/action/cat_cookies.php" method="POST">
                                                <td class="shoping__cart__item">
                                                    <img src="<?php echo $productImage; ?>" alt="Product Image" class="img-fluid col-12 col-sm-6 col-md-4 col-lg-3">
                                                    <h5><?php echo $productName; ?></h5>
                                                    <input type="hidden" name="pid" value="<?php echo $pId ?>">
                                                    <input type="hidden" name="pName" value="<?php echo $productName; ?>">
                                                    <input type="hidden" name="pPrice" value="<?php echo $productPrice; ?>">
                                                    <input type="hidden" name="pSkuId" value="<?php echo $skuId; ?>">
                                                    <input type="hidden" name="pDiscount" value="<?php echo $productPrice; ?>">
                                                    <!-- <input type="hidden" name="pQuantity" value="1"> -->
                                                    <input type="hidden" name="pCatId" value="<?php echo $catId; ?>">
                                                </td>
                                                <td class="shoping__cart__price">
                                                    ₹<?php echo number_format($productPrice, 2); ?>
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <!-- The quantity is now part of the form to submit on change -->
                                                            <input type="number" name="pQuantity" value="<?php echo $quantity; ?>" min="1">


                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    ₹<?php echo number_format($total, 2); ?>
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <button type="submit" class="btn btn-success" name="add_to_cart" value="1">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                    <a href="admin/action/cartRemove.php?pid=<?php echo $item['pid']; ?>" class="icon_close"></a>
                                                </td>
                                                <div class="col-md-12 text-right">

                                                </div>
                                            </form>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No items in your cart.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Update Cart Button -->


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="shop-grid.php" class="primary-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <!-- <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <?php
                            $subtotal = 0;
                            foreach ($cart as $item) {
                                $subtotal += $item['discountedPrice'] * $item['quantity'];
                            }
                            $totalAmount = $subtotal; // You can add tax, shipping, etc. if needed
                            ?>
                            <li>Subtotal <span>₹<?php echo number_format($subtotal, 2); ?></span></li>
                            <li>Total <span>₹<?php echo number_format($totalAmount, 2); ?></span></li>
                        </ul>
                        <?php $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : []; ?>
                        <a href="<?php echo count($cart)>0 ? 'checkout.php' : 'shop-grid.php' ?>" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Shoping Cart Section End -->

    <?php include './includes/footer.php' ?>