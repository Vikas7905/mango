<?php
// Start session if needed
session_start();

// Check if 'pid' is provided in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];  // Get the Product ID from the URL

    // Get the cart from cookies
    $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];

    // Loop through the cart and remove the product with the matching 'pid'
    foreach ($cart as $key => $item) {
        if ($item['pid'] == $pid) {
            // Remove the product from the cart array
            unset($cart[$key]);
            break; // Exit the loop once the product is found and removed
        }
    }

    // Reindex the array to fix any issues with array keys after removing the product
    $cart = array_values($cart);

    // Save the updated cart back to the cookie
    setcookie('user_cart', json_encode($cart), time() + (86400 * 30), "/");

    // Redirect back to the cart page or to another page
    header("Location: " . $_SERVER['HTTP_REFERER']); // Or any other page you want to redirect to
    exit;
}
?>
