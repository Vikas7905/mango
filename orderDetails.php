<?php include './includes/header.php'; ?>
<body>
    <?php include './includes/navbar.php'; ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order Details</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Order Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Order Details Section Begin -->
    <section class="order-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order__details__table">
                        <!-- Order ID from URL -->
                        <?php
                        // Get the order ID from the URL (using GET method)
                        if (isset($_GET['orderId'])) {
                            $orderId = $_GET['orderId'];
                        } else {
                            $orderId = "N/A";
                        }
                        ?>
                        <h3>Order ID: <?php echo $orderId; ?></h3>

                        <!-- Order Table -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Order 1 -->
                                <tr>
                                    <td>
                                        <a href="shop-details.php?id=1234">
                                        <img src="img/product/product-2.jpg" alt="Product 1" class="img-fluid" style="max-width: 100px;">
                                        </a>
                                    </td>
                                    <td>Product 1</td>
                                    <td><?php echo $orderId; ?></td>
                                    <td>March 5, 2025</td>
                                    <td>₹1,000.00</td>
                                </tr>

                                <!-- Example Order 2 -->
                                <tr>
                                    <td>
                                        <img src="img/product/product-2.jpg" alt="Product 2" class="img-fluid" style="max-width: 100px;">
                                    </td>
                                    <td>Product 2</td>
                                    <td><?php echo $orderId; ?></td>
                                    <td>March 5, 2025</td>
                                    <td>₹1,500.00</td>
                                </tr>

                                <!-- Example Order 3 -->
                                <tr>
                                    <td>
                                        <img src="img/product/product-2.jpg" alt="Product 3" class="img-fluid" style="max-width: 100px;">
                                    </td>
                                    <td>Product 3</td>
                                    <td><?php echo $orderId; ?></td>
                                    <td>March 5, 2025</td>
                                    <td>₹500.00</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Total Price -->
                        <div class="order-summary">
                            <h4>Total Order Amount: ₹3,000.00</h4>
                            <br>
                            <h6>Delivery Details</h6>
                            <p>Name: ABc</p>
                            <p>City: Mumbai</p>
                            <p>Address: ABc nagar mumbai </p>
                            <p>Phone: 9565XXXXX</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order Details Section End -->

    <!-- Footer Section Begin -->
    <?php include './includes/footer.php'; ?>
    <!-- Footer Section End -->
</body>
</html>
