<!DOCTYPE html>
<html lang="en">
<?php
include("backend/dbconnect.php");  
error_reporting(0);  
session_start(); 
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGitUP</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./img/DIGitUp.png" type="image">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css">
    
</head>

<body>
  <!-- 
    - #HEADER
  -->
  <div id="big">
  
  <div id="main">
  <main>
    <article class="article">

      <!-- 
        - #HERO
      -->

      <section class="section hero" aria-label="hero">
        <div class="container">

          <div class="hero-bg">
          <nav>
            <img src="./img/DIGitUp.png" alt="Digitup-logo" class="logo">DIGitUP
            <ul>
              <li><a href="./index.php">Home</a></li>
              <li><a href="./dishes.php">Dishes</a></li>
              <li><a href="./restaurants.php">Restaurents</a></li>
              <li><a href="./about.html">About</a></li>
              <li><a href="./contact.html">Contact us</a></li>
            </ul>
              <?php
              
              if(empty($_SESSION["suser"])) { // if user is not login
                  echo '<a href="login_signup.html" class="nav-link active" id="logReg">Login / Register</a>';
              } else {
                session_start(); 
                require("backend/dbconnect.php");
                $fname = $_SESSION["sfname"];
                $lname = $_SESSION["slname"];
                  echo '
                <img src="./img/menu/images/user.png" class="logo" onclick="toggleMenu()">
                <div class="sub-menu-wrap" id="subMenu">
                  <div class="sub-menu">
                    <div class="user-info">
                      <img src="./img/menu/images/user.png" alt="">
                      <h3>'. $fname . " " . $lname . '</h3>
                    </div>
                    <hr>

                    <a href="profile.php" class="sub-menu-link">
                      <img src="./img/menu/images/profile.png" alt="">
                      <p>Your Profile</p>
                      <span>></span>
                    </a>
                    <a href="./cart.php" class="sub-menu-link">
                      <img src="./img/menu/images/cart.png" alt="">
                      <p>Cart</p>
                      <span>></span>
                    </a>
                    <a href="./help&support.php" class="sub-menu-link">
                      <img src="./img/menu/images/help.png" alt="">
                      <p>Help & Support</p>
                      <span>></span>
                    </a>
                    <a href="./backend/logout.php" class="sub-menu-link">
                      <img src="./img/menu/images/logout.png" alt="">
                      <p>Log out</p>
                      <span>></span>
                    </a>

                  </div>
                </div>';
              }
              ?>
          </nav>
            <div class="hero-content">
              <h1 class="h1 hero-head">DIGitUP</h1>
              <h1 class="h1 hero-title">
                We will help you find your <span class="typed-text"></span><span class="cursor"></span>
              </h1>

              <p class="hero-text">
                Sizzling meal knocking at your door
              </p>

            </div>

          <div class="hero-form-wrapper">
            <div class="form-tab">

                <input type="text" id="searchInput" placeholder="Enter location or restaurant">
                <div id="map"></div>

            </div>
          </div>

        </div>
      </section>


      <!-- about section -->
      <section class="section about" aria-label="about">
        <div class="container">

          <div class="about-banner img-holder">
              <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

              <dotlottie-player src="https://lottie.host/ec383110-d880-4566-8bf2-a530c8bf1874/Ke6nKy0gHD.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
          </div>

          <div class="about-content">

            <h2 class="h2 section-title">Efficiency. Transparency. Control.</h2>

            <p>
                Our platform connects you to a curated selection of local restaurants, ensuring a delicious and hassle-free dining experience. 
                Whether you're craving the comforting warmth of homestyle classics, the bold flavors of international cuisines, or the freshest salads and sushi, our food delivery service has you covered. 
                Enjoy the ease of ordering through our user-friendly app or website, and let us bring the culinary world to you. Elevate your dining at home with our prompt and reliable delivery service, making every meal a delightful celebration.
            </p>

          </div>

        </div>
      </section>


      <!-- service -->

      <div id="services">
        <div class="container">
          <h1 style="color: black; text-align: center;" class="sub-title">OUR SERVICES</h1>
          <div class="services-list">

            <div class="elem">
              <h2>In your Reach</h2>
              <img
                src="./img/food/first.jpg" 
              />
            </div>
            <div class="elem">
              <h2>Within few minutes</h2>
              <img
                src="./img/food/second.jpg"
              />
            </div>
            <div class="elem">
              <h2>freshly prepared</h2>
              <img
                src="./img/food/third.jpg" 
              /> 
            </div>
          </div>
        </div>
      </div>

        <!-- Food -->
        <section class="section dish" aria-label="dish">
          <div class="dishes-container">

            <h2 class="h2 section-title">Featured Dishes</h2>

            <p class="section-text">A great platform to get freshly prepared dishes within few minutes.</p>

            <ul class="dish-list">
              <?php
              // Fetch random dishes from the dishes table
              $query = "SELECT * FROM dishes ORDER BY RAND() LIMIT 6";
              $result = $conn->query($query);

              // Display the dishes in the food cards
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $id = $row["id"];
                      $img = $row["img"];
                      $title = $row["title"];
                      $slogan = $row["slogan"];
                      $price = $row["price"];
                      echo '
                      <li>
                        <div class="dish-card">
                            <figure class="card-banner img-holder" style="--width: 370; --height: 250;">
                                <img src="./admin/img/dishes/' . $img . '" width="370" height="250" loading="lazy" alt="' . $title . '" class="img-cover">
                            </figure>
                            <button class="card-action-btn" aria-label="add to favourite">
                                <ion-icon name="heart" aria-hidden="true"></ion-icon>
                            </button>
                            <div class="card-content">
                                <h3 class="h3">
                                    <a href="dishes.php?id=' . $id . '" class="card-title">' . $title . '</a>
                                </h3>
                                <div class="card-meta">
                                    <div>
                                        <span class="meta-title">Price</span>
                                        <span class="meta-text">₹' . $price . '</span>
                                    </div>
                                    <!-- Add to Cart button here -->
                                    <button class="card-action-btn add-to-cart" aria-label="add to cart">
                                        <ion-icon name="cart" aria-hidden="true"></ion-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                      </li>
                      ';
                  }
              } else {
                  echo "Error: " . $query . "<br>" . $conn->error;
              }

              // Close the database connection
              $conn->close();
              ?>
            </ul>

          </div>
        </section>


        <!-- 
        - #CONTACT
      -->

        <section class="section contact" aria-label="contact">
          <div class="container">

            <h2 class="h2 section-title">Have Question ? Get in touch!</h2>

            <p class="section-text">
              A great plateform to get freshely prepared food within few minutes.
            </p>

            <a href="contact.html">
            <button class="btn btn-primary">
              
                <ion-icon name="call-outline"></ion-icon>
                <span class="span">Contact us</span>
              
            </button>
            </a>
          </div>
        </section>





        <!-- 
        - #NEWSLETTER
      -->

        <section class="newsletter" aria-label="newsletter">
          <div class="container">

            <div class="wrapper">
              <h2 class="h2 section-title">Subscribe to Newsletter!</h2>

              <p class="section-text">Subscribe to get latest updates and information.</p>
            </div>

            <form action="newsletter.php" class="newsletter-form" method="post">
              <input type="email" name="email_address" placeholder="Enter your email" aria-label="Enter your email"
                required class="email-field">

                <button type="submit" name="newsletter_submit" value="Submit" class="btn btn-secondary">Subscribe</button>
            </form>

          </div>
        </section>

       
        <!-- 
    - #FOOTER
  -->

        <footer class="footer">

          <div class="footer-top">
            <div class="container">

              <div class="footer-brand">

                <a href="#" class="logo">
                  <ion-icon name="cart-outline"></ion-icon> DIGitUP
                </a>

                <p class="footer-text">
                  A great plateform to get freshely prepared food within few minutes.
                </p>

              </div>

              <ul class="footer-list">

                <li>
                  <p class="footer-list-title">Company</p>
                </li>

                <li>
                  <a href="about.html" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">About us</span>
                  </a>
                </li>

                <li>
                  <a href="#" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Services</span>
                  </a>
                </li>

                <li>
                  <a href="#" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Pricing</span>
                  </a>
                </li>

                <li>
                  <a href="#" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Blog</span>
                  </a>
                </li>

                <li>
                  <a href="login_signup.html" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Login</span>
                  </a>
                </li>

              </ul>

              <ul class="footer-list">

                <li>
                  <p class="footer-list-title">Useful Links</p>
                </li>

                <li>
                  <a href="#" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Terms of Services</span>
                  </a>
                </li>

                <li>
                  <a href="#" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Privacy Policy</span>
                  </a>
                </li>

                <li>
                  <a href="#" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Listing</span>
                  </a>
                </li>

                <li>
                  <a href="contact.html" class="footer-link">
                    <ion-icon name="chevron-forward"></ion-icon>

                    <span class="span">Contact</span>
                  </a>
                </li>

              </ul>

              <ul class="footer-list">

                <li>
                  <p class="footer-list-title">Contact Details</p>
                </li>

                <li class="footer-item">
                  <ion-icon name="location-outline"></ion-icon>

                  <address class="address">
                    xyxyxyxyx<br>
                    558,<br>
                    485
                    <a href="#" class="address-link">View on Google map</a>
                  </address>
                </li>

                <li class="footer-item">
                  <ion-icon name="mail-outline"></ion-icon>

                  <a href="mailto:contact@example.com" class="footer-link">contact@example.com</a>
                </li>

                <li class="footer-item">
                  <ion-icon name="call-outline"></ion-icon>

                  <a href="tel:+152534468854" class="footer-link">+91 123 456 7890</a>
                </li>

              </ul>

            </div>
          </div>

          <div class="footer-bottom">
            <div class="container">

              <p class="copyright">
                &copy; 2023 DIGitUP. All Right Reserved by DIGitUP<a href="#" class="copyright-link"></a>
              </p>

              <ul class="social-list">

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-instagram"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-twitter"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-linkedin"></ion-icon>
                  </a>
                </li>

              </ul>

            </div>
          </div>

        </footer>
        
        <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
  </a>

  </div>
</div>


  <!-- 
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <!--
    - custom js link
  -->
    <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js" integrity="sha512-Ic9xkERjyZ1xgJ5svx3y0u3xrvfT/uPkV99LBwe68xjy/mGtO+4eURHZBW2xW4SZbFrF1Tf090XqB+EVgXnVjw==" 
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
  <!-- 
    - custom js link
  -->
    <script src="./script.js"></script>

</body>

</html>