<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php
            include "./includes/header.php"
        ?>
    </head>
    <body>
        <?php
            include "./includes/nav.php"
        ?>

        <div class="hero-carousel">
            <video autoplay muted loop id="MainVid">
                <source src="images/Chiron.mp4" type="video/mp4">
            </video>
            <div class="hero-data">
                <p class="hero-title">L U X A U T O</p>
                <p class="hero-description">The all new Bugatti Chiron now available</p>
            </div>
        </div>
        <div class="promo-cats">
            <div class="cat">
                <a href="brand.php">
                <img class="abs" src="images/hd/cat4.png"/>
                <h2 class="cat-desc">Browse Selections</h2>
                </a>
            </div>
            <div class="cat">
                <a href="reviews.php">
                <img class="abs" src="images/hd/cat2.png"/>
                <h2 class="cat-desc">Customer Reviews</h2>
                </a>
            </div>
            <div class="cat">
                <a href="about.php">
                <img class="abs" src="images/hd/cat3.png"/>
                <h2 class="cat-desc">About Us</h2>
                </a>
            </div>
        </div>
        <?php
            include "./includes/footer.php";
        ?>
    </body>
</html>
