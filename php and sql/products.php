<?php
include 'config.php';

// Get products from database
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Categories</title>
</head>
<style>
  body{
    padding-top: 70px;
    background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(images/back2.jpeg);
    background-size: cover;
    background-attachment: fixed;
  }


  .navbar {
    background-color: #000;
    border-color: rgba(255,255,255,0.15);
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .logo:hover {
    transform: scale(1.15);
    box-shadow: 0 0px 50px rgba(0, 0, 0,0.2);
  }

  .category-filters {
    margin-top: 40px;
    margin-bottom: 30px;
  }

  .category-item {
    margin-bottom: 30px;
  }

  .category-item .thumbnail img {
    height: 220px;
    object-fit: cover;
  }

  .footer {
    width: 100%;
    padding: 40px 1.6%;
    background: #000;
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
</style>
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
            <li class="active"><a href="products.php">Categories</a></li>
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
            <?php if (is_logged_in()): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="estate.php">Home</a></li>
            <li><a href="products.php">Categories</a></li>
            <li class="active">Flowerhub</li>
        </ol>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 col-md-4 col-sm-12 sidebar">
                <h4>Filters</h4>

                <!-- Brands -->
                <div class="panel panel-default">
                    <div class="panel-heading">Flower Types</div>
                    <div class="panel-body">
                        <label class="checkbox-inline">
                            <input type="checkbox"> Rose
                        </label><br>
                        <label class="checkbox-inline">
                            <input type="checkbox"> Sunflower
                        </label><br>
                        <label class="checkbox-inline">
                            <input type="checkbox"> Lily
                        </label><br>
                        <label class="checkbox-inline">
                            <input type="checkbox"> Daisy
                        </label>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="panel panel-default">
                    <div class="panel-heading">Price</div>
                    <div class="panel-body">
                        <input type="range" class="form-control" min="0" max="100" value="50">
                        <p>UGX0 - UGX100</p>
                    </div>
                </div>

                <!-- Sort By -->
                <div class="panel panel-default">
                    <div class="panel-heading">Sort By</div>
                    <div class="panel-body">
                        <select class="form-control">
                            <option>Popularity</option>
                            <option>Price - Low to High</option>
                            <option>Price - High to Low</option>
                            <option>Alphabetical</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="row">
                    <?php foreach($products as $product): ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="thumbnail product-item">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <div class="caption">
                                <h5><?php echo $product['name']; ?></h5>
                                <p class="price">UGX<?php echo number_format($product['price'], 2); ?></p>
                                <p class="rating">
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                                <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-block">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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