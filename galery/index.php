<?php
// Koneksi database
include '../product/db.php';

// Query untuk mengambil satu produk random
$sql = "SELECT * FROM product ORDER BY RAND()";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        // Ambil timestamp file CSS agar selalu ter-refresh
        $css_version = filemtime('style.css'); 
    ?>
    <link rel="stylesheet" href="style.css?v=<?php echo $css_version; ?>">
    
  <link rel="icon" type="image/x-icon" href="../img/shoes1.png">
</head>
<body>
    <nav id="navbar">
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    <a href="../home/index.php">
    <img src="../img/logo.png" alt="" loading="lazy" class="logo">
    </a>
    <a href="">
    <img src="../img/user.png" alt="" loading="lazy" class="userlogo">
    </a>
    <a href="">
    <img src="../img/bell.png" alt="" loading="lazy" class="bell">
    </a>
    <a href="../galery/index.php">
    <img src="../img/bag.png" alt="" loading="lazy" class="market">
    </a>
    <ul class="nav-links">
        <li><a href="#about-section-head">About</a></li>
        <li><a href="#our-products">Marketplace</a></li>
        <li><a href="#rate">Rate</a></li>
        <li><a href="#more-future">Future</a></li>
    </ul>
    </nav>

    <section id="our-products" class="section">
    <div class="container">
        <div class="products">
          <?php 
              if ($result->num_rows > 0): 
              while ($row = mysqli_fetch_assoc($result)): ?>
                  <div class="product">
                      <div class="catalog-card">
                          <!-- Gambar Produk -->
                          <div class="image-container">
                              <img src="../product/<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>" loading="lazy">
                          </div>
                          <!-- Informasi Produk -->
                          <div class="product-info">
                              <h2>$<?php echo $row['price']; ?></h2>
                          </div>
                          <p class="product-title"><?php echo $row['name']; ?></p>
                          <!-- Tombol SHOP NOW -->
                          <div class="shop-now">
                              <button>
                                  <img src="../img/cart.png" alt="Cart Icon" class="cart-icon">
                                  SHOP NOW
                              </button>
                          </div>
                      </div>
                  </div>
              <?php endwhile; 
          else: ?>
              <p>Tidak ada produk yang ditemukan.</p>
          <?php 
          endif; 

          $conn->close();
          ?>
                
                
                
                
                
                
        </div>
    </div>
    </section>





    

<footer class="footer">
  <div class="footer-container">
      <div class="footer-column">
          <h3>Resources</h3>
          <ul>
              <li><a href="#">Gift Cards</a></li>
              <li><a href="#">Find a Store</a></li>
              <li><a href="#">Membership</a></li>
              <li><a href="#">Nike x NBA</a></li>
              <li><a href="#">Nike Journal</a></li>
              <li><a href="#">Site Feedback</a></li>
          </ul>
      </div>
      <div class="footer-column">
          <h3>Help</h3>
          <ul>
              <li><a href="#">Get Help</a></li>
              <li><a href="#">Order Status</a></li>
              <li><a href="#">Shipping and Delivery</a></li>
              <li><a href="#">Returns</a></li>
              <li><a href="#">Order Cancellation</a></li>
              <li><a href="#">Payment Options</a></li>
              <li><a href="#">Gift Card Balance</a></li>
              <li><a href="#">Contact Us</a></li>
          </ul>
      </div>
      <div class="footer-column">
          <h3>Company</h3>
          <ul>
              <li><a href="#">About Nike</a></li>
              <li><a href="#">News</a></li>
              <li><a href="#">Careers</a></li>
              <li><a href="#">Investors</a></li>
              <li><a href="#">Purpose</a></li>
              <li><a href="#">Sustainability</a></li>
          </ul>
      </div>
      <div class="footer-column">
          <h3>Promotions & Discounts</h3>
          <ul>
              <li><a href="#">Student</a></li>
              <li><a href="#">Military</a></li>
              <li><a href="#">Teacher</a></li>
              <li><a href="#">First Responders & Medical Professionals</a></li>
              <li><a href="#">Birthday</a></li>
          </ul>
      </div>
  </div>
  <div class="footer-bottom">
      <p>© 2024 Nike, Inc. All Rights Reserved</p>
      <a href="#">Guides</a> | 
      <a href="#">Terms of Sale</a> | 
      <a href="#">Terms of Use</a> | 
      <a href="#">Nike Privacy Policy</a> | 
      <a href="#">Your Privacy Choices</a> | 
      <a href="#">CA Supply Chains Act</a>
  </div>
</footer>
<script src="script.js?v=<?php echo time(); ?>"></script>

</body>
</html>