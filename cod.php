<?php include './includes/header.php' ?>
<?php
if(isset($_COOKIE["user_cart"])) 
    {
     $_COOKIE["user_cart"];
     $jsonString = $_COOKIE["user_cart"];
     $data = json_decode($jsonString, true);
     print_r($data);
     echo $pid[0]; 
}
     else {
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