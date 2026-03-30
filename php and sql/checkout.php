<?php
include 'config.php';

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Get cart items
$sql = "SELECT c.quantity, p.id, p.name, p.price
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = $user_id";
$result = $conn->query($sql);
$cart_items = [];
$total = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total += $row['price'] * $row['quantity'];
    }
} else {
    redirect('view_cart.php'); // No items in cart
}

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $address = sanitize($_POST['address']);
    $city = sanitize($_POST['city']);
    $state = sanitize($_POST['state']);
    $zip = sanitize($_POST['zip']);
    $phone = sanitize($_POST['phone']);
    $payment_method = sanitize($_POST['payment_method']);

    // Create order
    $order_sql = "INSERT INTO orders (user_id, total, status) VALUES ($user_id, $total, 'pending')";
    if ($conn->query($order_sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Add order items
        foreach($cart_items as $item) {
            $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                        VALUES ($order_id, {$item['id']}, {$item['quantity']}, {$item['price']})";
            $conn->query($item_sql);
        }

        // Clear cart
        $clear_cart_sql = "DELETE FROM cart WHERE user_id = $user_id";
        $conn->query($clear_cart_sql);

        // Redirect to success page
        redirect('order_success.php?order_id=' . $order_id);
    } else {
        $error = "Order placement failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Checkout</title>
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

  .container {
    font-family: 'arial';
  }

  .footer {
    width: 100%;
    padding: 40px 1.6%;
    background-color: black;
    color: #fff;
    display: flex;
    text-align: left;
    border-top: 3px solid black;
    gap: 40px;
    overflow: hidden;
  }

  .footer .footer-col {
    margin-bottom: 1px;
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
  .footer .social-icons a{
    font-size: 30px;
    float: left;
  }
  .footer .social-icons a:hover{
    color: white;
  }
  .row{
    margin-top: 20px;
  }

  /* Checkout-specific Page Styling */
  .container {
    max-width: 1100px;
    margin: auto;
    font-family: 'Arial', sans-serif;
    color: #2a2a2a;
  }

  .breadcrumb {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    margin-bottom: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .panel {
    border-radius: 10px;
    border-color: #e1e1e1;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  }

  .panel-heading {
    background-color: #2b5b3f;
    color: white;
    border-radius: 10px 10px 0 0;
    padding: 14px 18px;
    font-size: 1.1rem;
  }

  .panel-body {
    background-color: #fff;
    padding: 20px;
    border-radius: 0 0 10px 10px;
  }

  .btn-success {
    background-color: #53fd53;
    border-color: #45cd45;
    color: #083b19;
    font-weight: 700;
  }

  .btn-success:hover {
    background-color: #45cd45;
    border-color: #39b239;
    color: #fff;
  }

  .form-control {
    border-radius: 8px;
    border-color: #ced4da;
    box-shadow: none;
  }

  .form-control:focus {
    border-color: #53fd53;
    box-shadow: 0 0 0 2px rgba(83, 253, 83, 0.15);
  }

  .list-group-item {
    border: none;
    color: #333;
    font-size: .95rem;
  }

  .panel.panel-default.order-review {
    background: #fefefe;
    border: 1px solid #ebebeb;
  }

  .panel.panel-default.order-review .panel-heading {
    background: #f2f7f3;
    color: #2d4f3d;
    border-bottom: 1px solid #e2e6e3;
  }

  .footer {
    background-color: #101010;
    color: #e9f9eb;
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
            <li><a href="view_cart.php">Cart</a></li>
            <li class="active"><a href="checkout.php">Checkout</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="view_cart.php" title="Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="estate.php">Home</a></li>
            <li><a href="view_cart.php">Cart</a></li>
            <li class="active">Checkout</li>
        </ol>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Checkout</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form id="checkout-form" method="post" action="checkout.php">
                    <!-- Shipping Address -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Shipping Address</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="first name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="last name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="your address" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" placeholder="city" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control" placeholder="district" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ZIP Code</label>
                                        <input type="text" name="zip" class="form-control" placeholder="code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" name="phone" class="form-control" placeholder="telephone no..." required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Payment</h4>
                        </div>
                        <div class="panel-body">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="credit_card" checked> Credit Card
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="paypal"> PayPal
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CVV</label>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Order Review & Summary -->
            <div class="col-md-4">
                <div class="panel panel-default order-review">
                    <div class="panel-heading">
                        <h4>Order Review</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <?php foreach($cart_items as $item): ?>
                            <li class="list-group-item">
                                <?php echo $item['name']; ?> ×<?php echo $item['quantity']; ?>
                                <span class="pull-right">UGX<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item">
                                Subtotal <span class="pull-right">UGX<?php echo number_format($total, 2); ?></span>
                            </li>
                            <li class="list-group-item">
                                Shipping <span class="pull-right">UGX9.99</span>
                            </li>
                            <li class="list-group-item">
                                Tax (8.875%) <span class="pull-right">UGX<?php echo number_format($total * 0.08875, 2); ?></span>
                            </li>
                            <hr>
                            <li class="list-group-item text-success">
                                <strong>Total <span class="pull-right">UGX<?php echo number_format($total + 9.99 + ($total * 0.08875), 2); ?></span></strong>
                            </li>
                        </ul>
                        <button type="submit" form="checkout-form" class="btn btn-success btn-block btn-lg">Place Order</button>
                        <a href="view_cart.php" class="btn btn-default btn-block">Return to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- /.container marketing -->
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