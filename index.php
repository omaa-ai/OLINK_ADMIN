<?php
require 'inc/Header.php';

?><?php

  $h = new Prozigzig();

  // Process login if form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] === 'login') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['stype'];

    // Determine table name based on user type
    $tableName = ($userType === 'mowner') ? 'admin' : 'tbl_bus_operator';

    // Call the login method
    $loginResult = $h->login($username, $password, $tableName);

    // Login successful - set session variables
    $_SESSION['busname'] = $username;
    $_SESSION['user_type'] = $userType;
    $_SESSION['language'] = $_POST['sel_lan'];
  }

  if (isset($_SESSION['busname'])) {
  ?>
<script>
  window.location.href = "dashboard.php";
</script>
<?php
  }
?>
<!-- login page start-->
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-12 p-0">
      <div class="login-card">
        <div>
          <div><a class="logo" href="#"><img class="img-fluid for-light" src="<?php echo $set['weblogo']; ?>" alt="loginpage"></a></div>
          <div class="login-main">
            <form class="theme-form" method="post">
              <h4 class="text-center">Sign in to account</h4>
              <p class="text-center">Enter your email & password to login</p>

              <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>

              <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input class="form-control" name="username" id="username" type="text" required placeholder="Username">
                <input type="hidden" name="type" value="login">
              </div>

              <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                  <input class="form-control" type="password" id="password-field" name="password" required placeholder="*********">
                </div>
              </div>

              <div class="form-group">
                <label class="col-form-label">Select User Type</label>
                <select class="form-control" name="stype" id="stype" required>
                  <option value="">Select A Type</option>
                  <option value="mowner">Master Admin</option>
                  <option value="sowner">Bus Operator</option>
                </select>
              </div>

              <div class="form-group">
                <label class="col-form-label">Select Dashboard Language</label>
                <select class="form-control" name="sel_lan" required>
                  <option value="">Select A Language</option>
                  <option value="en">English</option>
                  <option value="ar">Arabic</option>
                  <option value="gu">Gujarati</option>
                  <option value="ch">Chinese</option>
                  <option value="fr">French</option>
                  <option value="pr">Portuguese</option>
                  <option value="sp">Spanish</option>
                  <option value="ru">Russian</option>
                  <option value="hi">Hindi</option>
                </select>
              </div>

              <div class="form-group mb-0">
                <div class="text-end mt-3">
                  <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require 'inc/Footer.php'; ?>
</div>
</body>

</html>