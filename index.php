<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
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
                <img class="abs" src="images/hd/cat4.png"/>
                <p class="cat-desc">This is a cat</p>
            </div>
            <div class="cat">
                <img class="abs" src="images/hd/cat2.png"/>
                <p class="cat-desc">This is a cat</p>
            </div>
            <div class="cat">
                <img class="abs" src="images/hd/cat3.png"/>
                <p class="cat-desc">This is a cat</p>
            </div>
        </div>
    </body>
</html>
