<?php
include 'config.php';

if (!is_logged_in() || !isset($_GET['order_id'])) {
    redirect('estate.php');
}

$order_id = (int)$_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Verify order belongs to user
$order_sql = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id";
$order_result = $conn->query($order_sql);

if ($order_result->num_rows == 0) {
    redirect('estate.php');
}

$order = $order_result->fetch_assoc();

// Get order items
$items_sql = "SELECT oi.quantity, oi.price, p.name
              FROM order_items oi
              JOIN products p ON oi.product_id = p.id
              WHERE oi.order_id = $order_id";
$items_result = $conn->query($items_sql);
$order_items = [];
while($row = $items_result->fetch_assoc()) {
    $order_items[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Order Success</title>
<style>
  body {
    padding-top: 70px;
    background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(images/back2.jpeg);
    background-size: cover;
    background-attachment: fixed;
  }

  .navbar {
      background-color: black;
      border-color: rgba(255, 255, 255, 0.15);
    }

    .navbar .navbar-brand img {
      max-height: 56px;
      width: auto;
    }

    .navbar .navbar-nav > li > a {
      color: white;
    }

    .navbar .navbar-nav > li > a:hover {
      color: #53fd53;
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

  .success-message {
    text-align: center;
    margin: 50px 0;
    padding: 30px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .order-details {
    margin-top: 30px;
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
                <li><a href="login.php">Login</a></li>
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
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
        <div class="success-message">
            <h1 class="text-success"><i class="fa fa-check-circle"></i> Order Placed Successfully!</h1>
            <p>Thank you for your order. Your flowers will be delivered soon.</p>
            <p><strong>Order ID: #<?php echo $order_id; ?></strong></p>
        </div>

        <div class="row order-details">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Order Summary</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <?php foreach($order_items as $item): ?>
                            <li class="list-group-item">
                                <?php echo $item['name']; ?> ×<?php echo $item['quantity']; ?>
                                <span class="pull-right">UGX<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="list-group-item text-success">
                            <strong>Total: UGX<?php echo number_format($order['total'], 2); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>What's Next?</h4>
                    </div>
                    <div class="panel-body">
                        <p>You will receive an email confirmation shortly.</p>
                        <p>Our team will prepare your flowers and arrange for delivery.</p>
                        <p>Delivery typically takes 2-3 business days.</p>
                        <a href="products.php" class="btn btn-primary">Continue Shopping</a>
                        <a href="estate.php" class="btn btn-default">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
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