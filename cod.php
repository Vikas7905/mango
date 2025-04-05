<?php include './includes/header.php';

 ?>
<?php

 $host = "localhost";
 $db_name = "mangodb";
 $username = "root";
 $password = "root";


$conn = new mysqli($host, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if(isset($_COOKIE["user_cart"])) {
    $jsonString = $_COOKIE["user_cart"];
    $data = json_decode($jsonString, true);
    //print_r($data);
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
        $orderId=rand(1,100)."-".time().rand(99,100);
        $sgst=0;
        $cgst=0;
        $commision=0;
        
        // Example of how to use these variables for database insertion
        
        $query = "INSERT INTO orderDetails (orderId,userId, totalQuantity, subTotal, total,sgst,cgst,adminCommision) 
                VALUES ('$orderId','$customerId', '$quantity', '$subtotal', '$totalAmount',$sgst,$cgst,$commision)";

        $conn->query($query);
  

     
        // Insert order items
        foreach ($orderItems as $item) {
           echo $sql1 = "INSERT INTO orderitem (orderid,userid, productid, quantity, price, subtotal) 
                    VALUES ('$orderId','$customerId', '{$item['product_id']}', 
                            '{$item['quantity']}', '{$item['price']}', '{$item['subtotal']}')";

         $conn->query($sql1);

        }
        
    }

   // $conn->close();
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



    <!-- Checkout Section Begin -->

    <!-- Checkout Section End -->
<?php include './includes/footer.php' ?>