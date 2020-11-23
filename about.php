<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/about.css">

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    
        <?php
            include "./includes/header.php"
        ?>
</head>
<body>
        <?php
            include "./includes/nav.php"
        ?>
      <div class="jumbotron text-center" style="background:transparent !important; padding-top: 150px;">
  <h1>L U X A U TO</h1> 
  <p>Dreams within your reach</p> 
    </div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Us</h2><br>
      <h4>Founded in 2020 by a team of car enthusiast, LUXAUTO aims to bring car lovers' dreams to reality by offering them an experience in luxurious vehicles of exorbitant prices at affordable rates</h4><br>
      <p>Most people in the world will never experience the thrill of driving around with a vehicle that has a monetary value equivalent to that of someone’s home. This is where LUXAUTO steps in to bridge the gap between your dream and reality. At LUXAUTO, we believe that everyone should have a chance to enjoy engineering marvels and craftsmanship of rare automobiles from around the world. Brands that most can only dream of such as Bugatti, Pagani and many more are only an order away</p>
    </div>
      <img id="emblem" src="images/logos/Pagani-emblem.png"/>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
      <span id="globe" class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2><br>
      <h4><strong>MISSION:</strong> To bridge gap of exorbitant vehicles and people from all walks of life</h4><br>
      <p><strong>VISION:</strong> One day, every car fanatic from all over the world will not miss out on the experience of being in expertly crafted and engineered vehicles of the highest standards through years of hardship</p>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-ok-circle logo-small"></span>
      <h4>Checked</h4>
      <p>All vehicles go through thorough checks and maintenance before each rental</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-thumbs-up logo-small"></span>
      <h4>SERVICE</h4>
      <p>LUXAUTO receives over 95% of positive ratings by our customers</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-usd logo-small"></span>
      <h4>AFFORDABLE</h4>
      <p>All our vehicles come at affordable rates</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>HYBRID AND ELECTRIC</h4>
      <p>We offer the latest hybrid and electric supercars</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-earphone logo-small"></span>
      <h4>24-HOURS</h4>
      <p>Give us a call and we will be with you shortly</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-flash logo-small"></span>
      <h4>SPEED</h4>
      <p>Fast transaction and approvals for all customers</p>
    </div>
  </div>
</div>
  
  <h2 style="text-align: center;">What our customers say</h2>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"Love to experience different brands of expensive cars!"<br><span>Michael Roe, Vice President, Comment Box</span></h4>
      </div>
      <div class="item">
        <h4>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
      </div>
      <div class="item">
        <h4>"Could I... BE any more happy with this company?"<br><span>Paige Chua, Actress, MediaCorp</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
<?php
            include "./includes/footer.php";
        ?>
</body>
</html>