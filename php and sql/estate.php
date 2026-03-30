<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Home</title>
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

  .video-container {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 8px;
  }

  .video-section {
    background: #f9f9f9;
    padding: 40px 0;
    margin: 30px 0;
  }

  .video-section h2 {
    color: #16b33d;
    margin-bottom: 30px;
    font-weight: 600;
  }

  .video-description {
    font-size: 16px;
    line-height: 1.6;
    color: #333;
    margin-bottom: 20px;
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
            <li class="active"><a href="estate.php">Home</a></li>
            <li><a href="cartegory.html">Categories</a></li>
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
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="hover">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide img-responsive" src="images/image1.jpeg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>WELCOME TO FLOWERHUB..</h1>
              <p>We are the flower hub, purchase flowers of your choice to beautify your mood.</p>
              <p><a class="btn btn-lg btn-primary" href="signup.php" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide img-responsive" src="images/image2.jpeg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>IT IS THE BEST</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="products.php" role="button">Shop Now</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide img-responsive" src="images/image3.jpeg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="gallary.html" role="button">Browse Gallery</a></p>
            </div>
          </div>
        </div>
      </div>

      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->

  <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="images/back2.jpeg" alt="Generic placeholder image" width="300" height="300">
          <h2>Rose Flower</h2>
          <p>A rose flower is a classic symbol of love and beauty. Here's a quick description:
              Color: Typically red, but also comes in pink, yellow, white, and more
              Petals: Soft, velvet-like, and layered in a spiral pattern
              Center: Yellow stamens surrounded by delicate petals
              Stem: Thorny and slender, with green leaves
              Scent: Sweet and romantic, varying by variety
           </p>
          <p><a class="btn btn-default" href="products.php" role="button">View details &raquo;</a></p>
        </div>

        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="images/daisy.jpeg" alt="Generic placeholder image" width="300" height="300">
          <h2>Daisy Flower</h2>
          <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
          <p><a class="btn btn-default" href="products.php" role="button">View details &raquo;</a></p>
        </div>

        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="images/hibiscus.jpeg" alt="Generic placeholder image" width="300" height="300">
          <h2>Hibiscus Flower</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="products.php" role="button">View details &raquo;</a></p>
        </div>

        <!-- /.col-lg-4 -->
      </div><!-- /.row -->

      <!-- Featured Products Section -->
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Fresh Flowers <span class="text-muted">Direct from Garden</span></h2>
          <p class="lead">We provide the freshest flowers sourced directly from our premium flower gardens. Each arrangement is carefully selected and hand-prepared by our expert florists to ensure maximum freshness and beauty. Our flowers are delivered within 24 hours of plucking.</p>
          <a href="products.php" class="btn btn-lg btn-success">Shop Fresh Flowers</a>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="images/image1.jpeg" alt="Generic placeholder image">
        </div>
      </div>

      <!-- Video Section -->
      <div class="video-section">
        <div class="container">
          <h2>Watch Our Flower Journey</h2>
          <div class="row">
            <div class="col-md-6">
              <div class="video-description">
                <p>Experience the beauty of nature through our lens. Watch as we take you on a journey from our flower gardens to your doorstep. See how we carefully select and prepare each flower arrangement with love and dedication.</p>
                <p>Our expert florists share their passion for flowers and demonstrate the art of creating stunning bouquets that bring joy to every occasion.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="video-container">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Flower Journey Video" allowfullscreen></iframe>
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