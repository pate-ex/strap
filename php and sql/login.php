<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            redirect('estate.php'); // Redirect to home after login
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pVn3f9zpmS4OqsfYJWS8EjmEboN3l6x6SU1AB2Juc1L3XNzq2B1xWZqUeWjT0KF6j0J1qf3Q5Wv0jzKc1N2G7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Login</title>
  <style>
    body {
      padding-top: 70px;
      background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(images/back2.jpeg);
      background-size: cover;
      background-attachment: fixed;
    }

    .navbar {
      background-color: #000;
      border-color: rgba(255, 255, 255, 0.15);
    }

    .navbar .navbar-brand img {
      max-height: 56px;
      width: auto;
    }

    .navbar .navbar-nav > li > a {
      color: #fff;
    }

    .navbar .navbar-nav > li > a:hover {
      color: #53fd53;
    }

    /* center main nav links */
    .navbar .navbar-collapse {
      text-align: center;
    }

    .navbar .navbar-nav {
      float: none;
      display: inline-block;
    }

    .navbar .navbar-nav > li {
      float: none;
      display: inline-block;
    }

    .navbar .navbar-toggle .icon-bar {
      background-color: #fff;
    }

    .logo {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.15);
      box-shadow: 0 6px 20px rgba(83, 253, 83, 0.4);
    }

    .auth-container {
      max-width: 400px;
      margin: 120px auto 60px;
      padding: 30px;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
      color: #fff;
    }

    .auth-container h2 {
      margin-bottom: 24px;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #fff;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.15);
      border-color: #53fd53;
      color: #fff;
      box-shadow: 0 0 10px rgba(83, 253, 83, 0.3);
    }

    .btn-primary {
      background-color: #53fd53;
      border-color: transparent;
      color: #000;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #39c936;
      color: #000;
    }

    /* Shared footer styling */
    .footer {
      margin-top: 40px;
      width: 100%;
      padding: 40px 1.6%;
      background: #000;
      color: #fff;
      border-top: 3px solid #000;
    }

    .footer .footer-col {
      margin-bottom: 30px;
    }

    .footer h3 {
      font-weight: 600;
      margin-bottom: 15px;
      letter-spacing: 1px;
      color: #53fd53;
      font-size: 18px;
    }

    .footer a {
      display: block;
      color: #16b33d;
      margin-bottom: 12px;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 14px;
      line-height: 1.8;
    }

    .footer a:hover {
      color: #53fd53;
      padding-left: 10px;
    }

    .footer .social {
      margin-top: 12px;
    }

    .footer .social a {
      display: inline-block;
      margin-right: 12px;
      font-size: 20px;
      color: #16b33d;
    }

    .footer .social a:hover {
      color: #53fd53;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <img class="logo" src="images/logo1.jpeg">
        </a>
      </div>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <img class="logo" src="images/logo1.jpeg">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="estate.php">Home</a></li>
          <li><a href="products.php">Categories</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="potfolio.html">Potfolio</a></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="products.php">Categories</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Others</li>
              <li class="active"><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
              <li><a href="gallary.html">Gallary</a></li>
              <li><a href="view_cart.php">Cart</a></li>
              <li><a href="checkout.php">Checkout</a></li>
            </ul>
          </li>
        </ul>


        <ul class="nav navbar-nav navbar-right">
          <li><a class="glyphicon glyphicon-shopping-cart " href="view_cart.php">Cart</a>
          </li>
          <li><a href="signup.php">Sign up</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
    </div>
  </nav>

  <div class="container auth-container">
    <h2 class="text-center">Login</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="login.php">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Log in</button>
      <p class="text-center" style="margin-top:12px;">
        Don't have an account? <a href="signup.php" style="color:#53fd53;">Sign up</a>
      </p>
    </form>
  </div>

  <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-4 footer-col">
            <h3>Contact</h3>
              <a href="tel:+256754411788"><i class="fa fa-phone"></i> Phone: +256 754 411 788</a>
              <a href="mailto:flowerhub@gmail.com"><i class="fa fa-envelope"></i> Email: flowerhub@gmail.com</a>
              <a href="#"><i class="fa fa-map-marker"></i> Address: P.O.BOX 123, Acacia Avenue, Kampala(U)</a>
          </div>
          <div class="col-sm-12 col-md-4 footer-col">
            <h3>Menu</h3>
            <a href="estate.php">Home</a>
            <a href="about.html">About</a>
            <a href="gallary.html">Gallery</a>
            <a href="products.php">Categories</a>
            <a href="contact.html">Contact</a>
          </div>
          <div class="col-sm-12 col-md-4 footer-col text-right">
            <h3>© 2026 Flowerhub.com</h3>
            <p>Helping nature, one tree at a time.</p>
          </div>
        </div>
      </div>
    </footer>

  <script src="https://code.jquery.com/jquery-1.12.4.js"
    integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
    crossorigin="anonymous"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>