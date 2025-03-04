<?php
session_start();

// Check if the 'add_to_cart' button was clicked
if (isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == "1") {
    // Retrieve product data from the form
    $pid = $_POST['pid'];
    $pName = $_POST['pName'];
    $pPrice = $_POST['pPrice'];
    $pSkuId = $_POST['pSkuId'];
    $pDiscount = $_POST['pDiscount'];
    $pQuantity = $_POST['pQuantity'];
    $pCatId = $_POST['pCatId'];
    $discountPrice = ($pPrice * $pDiscount) / 100;
    $discountedPrice = floor($pPrice - $discountPrice);

    // Prepare the product data to be stored in the cart
    $product = array(
        "pid" => $pid,
        "productName" => $pName,
        "price" => $pPrice,
        "skuId" => $pSkuId,
        "discount" => $pDiscount,
        "quantity" => $pQuantity,
        "catId" => $pCatId,
        "discountedPrice" => $discountedPrice
    );
    // print_r($product);
    // Check if the user already has a cart in the cookies
    $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];

    // Check if the product already exists in the cart, and update the quantity if it does
    $found = false;
    foreach ($cart as &$item) {
        if ($item['pid'] == $pid) {
            $item['quantity'] = $pQuantity; // Update the quantity to the new value
            $found = true;
            break;
        }
    }

    // If the product is not found in the cart, add it to the cart
    if (!$found) {
        $cart[] = $product; // Add the product if it's not in the cart
    }

    // Store the updated cart in the cookie (valid for 30 days)
    setcookie('user_cart', json_encode($cart), time() + (86400 * 30), "/");

    // Redirect to the product page or a cart page after adding to cart
    header("Location: " . $_SERVER['HTTP_REFERER']);  // Redirect back to the previous page (or customize the URL as needed)
    exit;
}
?>
