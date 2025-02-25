<?php include './includes/header.php'; ?>
<style>
    /* Registration Page Styles */
.register-section {
  padding: 100px 0;
}

.register-form {
  background-color: #fff;
  padding: 40px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.register-form h3 {
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

.login {
  text-align: center;
  margin-top: 10px;
}

.login a {
  color: #4CAF50;
  text-decoration: none;
}

</style>
<body>
  <?php include './includes/navbar.php'; ?>

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb2.png">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>Register</h2>
            <div class="breadcrumb__option">
              <a href="./index.php">Home</a>
              <span>Register</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Registration Form Section Begin -->
  <section class="register-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
          <div class="register-form">
            <h3>Create an Account</h3>
            <form action="admin/action/userRegisterpost.php" method="POST">
              <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
              </div>
              <div class="input-group">
                <label for="mobile">Mobile</label>
                <input type="tel" id="mobile" name="mobile" required>
              </div>
              <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
              </div>
              <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
              </div>
              <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">I agree to the Terms and Conditions</label>
              </div> -->
              <button type="submit" class="primary-btn">Register</button>
            </form>
            <p class="login">
              Already have an account? <a href="login.php">Login here</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Registration Form Section End -->

  <?php include './includes/footer.php'; ?>
</body>
