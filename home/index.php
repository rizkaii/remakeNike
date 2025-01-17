<?php
// Koneksi database
include '../product/db.php';

// Query untuk mengambil satu produk random
$sql = "SELECT * FROM product ORDER BY RAND() LIMIT 4";
$result = $conn->query($sql);
?>
<?php
// Memulai session untuk memeriksa status login
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login/index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nike by Rizal Lazuardi</title>
  <?php
        // Ambil timestamp file CSS agar selalu ter-refresh
        $css_version = filemtime('style.css'); 
    ?>
    <link rel="stylesheet" href="style.css?v=<?php echo $css_version; ?>">
    
  <link rel="icon" type="image/x-icon" href="../img/shoes1.png">
</head>
<body>

<!-- Navbar -->

<nav id="navbar">
      <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
      </div>
  <img src="../img/logo.png" alt="" loading="lazy" class="logo">
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


<header>
    <div class="box-head">
        <div class="shoes-header">
            <img src="../img/sample.jpg" alt="" loading="lazy">
        </div>
    </div>
</header>
<!-- Sections -->
<section id="about-section-head" class="section">
    <div class="about-section">
        <div class="about-content">
          <div class="title">
            <h1>ABOUT ME</h1>
          </div>
          <div class="description">
            <p>Nike, Inc., is one of the largest and best-recognized global sports and athleticwear brands. Its extensive lineup includes its long-running Air Jordan, Air Force 1, and other "Air" models. Converse shoes and apparel (including those bearing the iconic Chuck Taylor All Stars logo) have also been a part of Nike since its 2003 acquisition.</p>
          </div>
        </div>
        <div class="about-container">
          <div class="about-img">
            
              <h3 class="name1">PHILIP</h3>
              <h3 class="name2">HAMPSON</h3>
              <h3 class="name3">KNIGHT</h3>
              <div class="image-philip">
                <img src="https://mastersofscale.com/wp-content/uploads/2022/09/MoS_PhilKnight_colorcutout-400x400.webp" alt="Gambar 1">

              </div>
              <p>Nike was co-founded by Phil Knight and his former track coach, Bill Bowerman, in 1964. Originally named "Blue Ribbon Sports," the company started as a distributor for the Japanese brand Onitsuka Tiger (now ASICS). The idea emerged when Knight, then a University of Oregon runner and Stanford MBA student, saw potential in selling quality running shoes made in Japan to compete with German brands like Adidas and Puma, which dominated the U.S. market at the time.</p>
            
          </div>
        </div>
        
        <div class="stats">
          <div class="stat">
            <h2 id="#percentage1" data-target="42">0%</h2>
            <p>of NIKE’s leadership positions are held by women.</p>
          </div>
          <div class="stat">
            <h2 id="#percentage2" data-target="74">0%</h2>
            <p>renewable energy in owned or operated facilities, up from 48% in FY20.</p>
          </div>
          <div class="stat">
            <h2 id="#percentage3" data-target="97.7">0</h2>
            <p>invested in NIKE, Inc.'s fiscal year 2021 to drive positive impact in communities around the world.</p>
          </div>
        </div>
      </div>
      
</section>
<div class="figure">
  <img src="../img/nike.png" alt="" loading="lazy">
  <div class="text-figure">
    <div class="title-figure">
      <h1>NIKE FOR <span>SPORT</span></h1>
    </div>
    <h2>__________________</h2>
    <div class="text-under-title">
      <p>Nike sports shoes are known for their blend of style, comfort, and cutting-edge technology. Each pair is crafted to enhance athletic performance while delivering a fashionable look, making them popular both on and off the field.</p>
    </div>
    <br>
  </div>
  <div class="text-two">
    <h1>Advanced</h1>
    <h2>Chousing</h2>
    <p>
      Many Nike shoes use proprietary foam technology like Zoom Air, React, or Air Max to provide responsive cushioning. These materials absorb impact and give energy return, which helps reduce fatigue and improves performance during running, jumping, or quick movements.
    </p>
    <br>
    <p>
      Nike sports shoes often use lightweight, breathable materials, such as mesh, flyknit, or engineered textiles. This construction allows for optimal airflow, keeping feet cool and comfortable even during intense workouts.
    </p>
    <h2>____________________</h2>
  </div>
</div>

<section id="our-products" class="section">
    <div class="container">
        <h1>OUR <span class="highlight">PRODUCT</span></h1>
        <div class="product-info">
            <p>Most Nike shoes use a mix of leather, fabric, foam, and rubber. The Nike classics and deluxe model basketball shoes will have real leather parts. Nike running shoes and modern performance baseball shoes are generally made with lightweight fabric uppers in place of heavier leather.</p>
            <img src="../img/sample.jpg" alt="Nike Shoe" loading="lazy">
        </div>
        <div class="products">
          <?php 
              if ($result->num_rows > 0): 
              while ($row = mysqli_fetch_assoc($result)): ?>
                  <div class="product">
                      <div class="catalog-card">
                          <!-- Gambar Produk -->
                          <div class="image-container">
                              <img src="../product/<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
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
        <div style="text-align: center; margin-top: 50px;">
            <!-- Tombol Shop Now -->
            <a href="../galery/index.php" class="shop-now-btn">
                <span>SHOP NOW</span>
            </a>
        </div>
    </div>
</section>






<section class="testimonial-section" id="rate">
  <h1>TESTIMONIAL</h1>
  <div class="testimonial-container">
      <div class="testimonial-box1">
          <img src="https://cdn.prod.website-files.com/6600e1eab90de089c2d9c9cd/662c092880a6d18c31995dfd_66236531e8288ee0657ae7a7_Business%2520Professional.webp" alt="Neil Patel">
          <h3>NEIL PATEL</h3>
          <div class="stars">
              <span style="color: rgb(255, 255, 255);">★★★★★</span>
          </div>
          <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
      </div>
      <div class="testimonial-box2">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwRPWpO-12m19irKlg8znjldmcZs5PO97B6A&s" alt="Celia Rins">
          <h3>CELIA RINS</h3>
          <div class="stars">
              <span style="color: rgb(255, 255, 255);">★★★★☆</span>
          </div>
          <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
      </div>
      <div class="testimonial-box3">
          <img src="https://blog-pixomatic.s3.appcnt.com/image/22/01/26/61f166e1377d4/_orig/pixomatic_1572877223091.png" alt="Mike Demien">
          <h3>MIKE DEMIEN</h3>
          <div class="stars">
              <span style="color: rgb(255, 255, 255);">★★☆☆☆</span>
          </div>
          <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
      </div>
  </div>
</section>




<div class="contact-container">
  <h2>Contact me</h2>
  <form id="contact-form" action="send.php" method="post">
    <div class="form-group">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" placeholder="name...." required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="email...." required>
    </div>
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" placeholder="message...." required></textarea>
    </div>
    <button type="submit" class="submit-button">Send</button>
  </form>
</div>

<section id="more-future" class="section">
  <div class="future-section">
    <h2>The Future of Nike Shoes</h2>
    <p>
      Nike shoes will continue to lead the way in innovation within the sports industry, featuring advanced technology and futuristic designs. In the future, Nike is committed to delivering products that not only enhance athletic performance but also prioritize environmental sustainability.
    </p>
    <p>
      We will introduce collections of shoes made from recycled materials and eco-friendly technologies, allowing users to engage in sports with a conscious mind about their impact on the planet. Additionally, Nike shoes will be equipped with smart features, such as integrated performance tracking systems, enabling users to monitor their progress in real-time.
    </p>
    <p>
      With increasingly improved ergonomic designs, every step will provide optimal comfort and support. We believe that the future of Nike shoes will create a more personalized and enjoyable sports experience, inspiring a new generation to participate in physical activities.
    </p>
  </div>
</section>

<footer class="footer">
  <div class="footer-container">
      <!-- <div class="footer-column">
          <h4 class="toggle">Resources <span>&#9662;</span></h4>
          <ul>
              <li><a href="#">Gift Cards</a></li>
              <li><a href="#">Find a Store</a></li>
              <li><a href="#">Membership</a></li>
              <li><a href="#">Nike x NBA</a></li>
              <li><a href="#">Nike Journal</a></li>
              <li><a href="#">Site Feedback</a></li>
          </ul>
      </div> -->
      <div class="footer-column">
          <h4 class="toggle">Help <span>&#9662;</span></h4>
          <ul class="footer-list">
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
          <h4 class="toggle">Company <span>&#9662;</span></h4>
          <ul class="footer-list">
              <li><a href="#">About Nike</a></li>
              <li><a href="#">News</a></li>
              <li><a href="#">Careers</a></li>
              <li><a href="#">Investors</a></li>
              <li><a href="#">Purpose</a></li>
              <li><a href="#">Sustainability</a></li>
          </ul>
      </div>
      <div class="footer-column">
          <h4 class="toggle">Promotions & Discounts <span>&#9662;</span></h4>
          <ul class="footer-list">
              <li><a href="#">Student</a></li>
              <li><a href="#">Military</a></li>
              <li><a href="#">Teacher</a></li>
              <li><a href="#">First Responders & Medical Professionals</a></li>
              <li><a href="#">Birthday</a></li>
          </ul>
      </div>
  </div>
  <div class="footer-bottom">
      <p>© 2025 Rizal lazuardi</p>
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
