<?php include './includes/header.php' ?>
<?php
if(isset($_COOKIE["user_cart"])) {
    $jsonString = $_COOKIE["user_cart"];
    $data = json_decode($jsonString, true);
    print_r($data);
    if (is_array($data)) {
        // Initialize variables for database insertion
        $orderItems = array();
        $totalAmount = 0;
        
        // Process each item in cart
        foreach ($data as $item) {
            // Set individual item variables
           // $productId = $item['productId'];
            $productName = $item['productName'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $subtotal = $quantity * $price;
            
            // Add to total amount
            $totalAmount += $subtotal;
            
            // Prepare order item for insertion
            $orderItems[] = array(
              //  'product_id' => $productId,
                'product_name' => $productName,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal
            );
        }
        
        // Set order variables
        $orderDate = date('Y-m-d H:i:s');
        $orderStatus = 'pending';
        $customerId = $_SESSION['user_id']; // Assuming you have user session
        
        // Example of how to use these variables for database insertion
        /*
        $sql = "INSERT INTO orders (customer_id, order_date, total_amount, status) 
                VALUES ('$customerId', '$orderDate', '$totalAmount', '$orderStatus')";
        
        // After inserting order, get the order_id
        $orderId = $conn->insert_id;
        
        // Insert order items
        foreach ($orderItems as $item) {
            $sql = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price, subtotal) 
                    VALUES ('$orderId', '{$item['product_id']}', '{$item['product_name']}', 
                            '{$item['quantity']}', '{$item['price']}', '{$item['subtotal']}')";
        }
        */
        
        // Display the prepared data
        echo "Total Amount: $" . number_format($totalAmount, 2) . "<br>";
        echo "Number of Items: " . count($orderItems) . "<br>";
        echo "Order Date: " . $orderDate . "<br>";
    }
} else {
    echo "Cookie is not set!";
}
?>
<body>
  <?php  include './includes/navbar.php' ?>
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
<?php
    echo $_POST['village'];
    echo $_POST['country'];
    echo $_POST['pincode'];

?>


    <!-- Checkout Section Begin -->

    <!-- Checkout Section End -->
<?php include './includes/footer.php' ?>