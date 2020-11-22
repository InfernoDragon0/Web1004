<nav class="top-navigator">
    <div class="logo">
        <a href="./index.php">
        <img src="images/logos/companylogo.png" height="40"> 
        </a>
    </div>

    <ul class="links">
        <a class="link" href="./">HOME</a>
        <a class="link" href="./about.php">ABOUT</a>
        <div class="dd link">
            <a href="#">BRANDS</a>
            <div class="dd-content">
                <a href="./brand.php?brand=bugatti">Bugcatti</a>
                <a href="./brand.php?brand=lamboghini">Lamboghini</a>
                <a href="./brand.php?brand=cat">Cat</a>
            </div>
        </div>
        <a class="link" href="./reviews.php">REVIEWS</a>

        <?php
            //sesion magic
            session_start();
            if (isset($_SESSION['memberid'])) {
                ?>
                    <div class="dd link">
                        <a href="#"><?php echo $_SESSION['name']?></a>
                        <div class="dd-content">
                            <a href="./account.php">View Profile</a>
                            <?php
                                if(isset($_SESSION['memberid']) && $_SESSION['isAdmin']) {
                                    ?>
                                    <a href="./admin.php">Admin Panel</a>
                                    <?php
                                }
                            ?>
                            <a href="./checkout.php">Checkout</a>
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>

                <?php
            }
            else {
                ?>
                <a class="link" href="./login.php">LOGIN</a>
                <?php
            }
        ?>
    </ul>
</nav>
<div class="bg"></div>
