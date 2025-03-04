<?php include './includes/header.php'; ?>
<style>
    /* Login Page Styles */
.login-section {
  padding: 100px 0;
}

.login-form {
  background-color: #fff;
  padding: 40px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.login-form h3 {
  text-align: center;
  margin-bottom: 30px;
}

.input-group {
  margin-bottom: 20px;
}

.input-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

.input-group input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.form-check {
  margin-bottom: 20px;
}

.form-check-input {
  margin-right: 10px;
}

.primary-btn {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
}

.primary-btn:hover {
  background-color: #45a049;
}

.forgot-password {
  text-align: center;
}

.register {
  text-align: center;
  margin-top: 10px;
}

.register a {
  color: #4CAF50;
  text-decoration: none;
}

</style>
<body>
  <?php include './includes/navbar.php';
  $decoded= isset($_SESSION['decoded'])?$_SESSION['decoded']:"";
  print_r($decoded);
  ?>

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>Change</h2>
            <div class="breadcrumb__option">
              <a href="./index.php">Home</a>
              <span>changePassword</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Login Form Section Begin -->
  <section class="login-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
          <div class="login-form">
            <h3>Change Password</h3>
            <form action="admin/action/login_post.php" method="POST">
              <div class="input-group">
                <label for="username">New Password</label>
                <input type="text" id="username" name="email" required>
              </div>
              <!-- <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
              </div> -->
              <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
              </div> -->
              <button type="submit" class="primary-btn">Change</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Login Form Section End -->

  <?php include './includes/footer.php'; ?>
</body>
