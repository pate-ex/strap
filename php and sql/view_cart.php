<?php
include 'config.php';

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Get cart items
$sql = "SELECT c.id as cart_id, c.quantity, p.id, p.name, p.price, p.image
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
}

// Handle remove from cart
if (isset($_GET['remove'])) {
    $cart_id = (int)$_GET['remove'];
    $delete_sql = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id";
    $conn->query($delete_sql);
    redirect('view_cart.php');
}

// Handle update quantity
if (isset($_POST['update_cart'])) {
    foreach($_POST['quantity'] as $cart_id => $quantity) {
        $quantity = (int)$quantity;
        if ($quantity > 0) {
            $update_sql = "UPDATE cart SET quantity = $quantity WHERE id = $cart_id AND user_id = $user_id";
            $conn->query($update_sql);
        } else {
            $delete_sql = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id";
            $conn->query($delete_sql);
        }
    }
    redirect('view_cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Shopping Cart</title>
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

  /* Medium-size carousel styling */
  .carousel {
    max-height: 520px;
    overflow: hidden;

  }

  .carousel .item img {
    width: 100%;
    height: 520px;
    object-fit: cover;
  }

  @media (max-width: 768px) {
    .carousel .item img {
      height: 320px;
    }
  }

  .container {
    font-family: 'arial';
  }

  .panel-heading img {
    border-radius: 20px;
    width: 30%;
  }

  .panel-body {
    width: 30%;
    height: 100%;
        padding: 0;
    height: 10px;
    width: 100%;
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
    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="estate.php">Home</a></li>
            <li><a href="products.php">Categories</a></li>
            <li class="active">Shopping Cart</li>
        </ol>
    </div>

    <div class="container">
        <div class="row">
            <!-- Cart Table -->
            <div class="col-md-9">
                <h2>Shopping Cart</h2>
                <p class="lead">Review your items below.</p>
                <?php if (empty($cart_items)): ?>
                    <p>Your cart is empty. <a href="products.php">Continue shopping</a></p>
                <?php else: ?>
                <form method="post" action="view_cart.php">
                    <table class="table table-striped table-hover cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart_items as $item): ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-cart" style="width: 50px; height: 50px;">
                                        </div>
                                        <div class="media-body">
                                            <h5><?php echo $item['name']; ?></h5>
                                        </div>
                                    </div>
                                </td>
                                <td>UGX<?php echo number_format($item['price'], 2); ?></td>
                                <td>
                                    <input type="number" name="quantity[<?php echo $item['cart_id']; ?>]" class="form-control qty-input" value="<?php echo $item['quantity']; ?>" min="1">
                                </td>
                                <td class="cart-total">UGX<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <a href="view_cart.php?remove=<?php echo $item['cart_id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
                </form>
                <?php endif; ?>
            </div>

            <!-- Cart Summary -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cart Summary</h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>Total: UGX<?php echo number_format($total, 2); ?></strong></p>
                        <a href="checkout.php" class="btn btn-success btn-block">Proceed to Checkout</a>
                        <a href="products.php" class="btn btn-default btn-block">Continue Shopping</a>
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