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
            <img class="abs" src="images/hd/hero.png"/>
            <div class="hero-data">
                <p class="hero-title">B U G C A T T I</p>
                <p class="hero-description">This is a car</p>
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
        ^ not actual carousel yet, and NOT YET RESPONSIVE to height < 1080px
    </body>
</html>
