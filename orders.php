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
                        <!-- Sample Order Details (Static Data) -->
                        <h3>Order ID: 123456</h3>
                        <!-- Order Table -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Order 1 -->
                                <tr>
                                    <style>
                                    </style>
                                    <td>
                                    <a href="orderDetails.php?orderId=123456">
                                        <img src="img/product/product-2.jpg" alt="Product 1" class="img-fluid" style="max-width: 100px;">
                                    </a>
                                    </td> </a>
                                    <td><a href="orderDetails.php?orderId=123456">Product 1 </a></td>
                                    <td><a href="orderDetails.php?orderId=123456">123456 </a></td>
                                    <td><a href="orderDetails.php?orderId=123456">March 5, 2025 </a></td>
                                </tr>
                                <!-- Example Order 2 -->
                                <tr>
                                    <td>
                                        <img src="img/product/product-2.jpg" alt="Product 2" class="img-fluid" style="max-width: 100px;">
                                    </td>
                                    <td>Product 2</td>
                                    <td>123456</td>
                                    <td>March 5, 2025</td>
                                </tr>
                                <!-- Example Order 3 -->
                                <tr>
                                    <td>
                                        <img src="img/product/product-2.jpg" alt="Product 3" class="img-fluid" style="max-width: 100px;">
                                    </td>
                                    <td>Product 3</td>
                                    <td>123456</td>
                                    <td>March 5, 2025</td>
                                </tr>
                            </tbody>
                        </table>
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
