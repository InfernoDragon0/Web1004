<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button fixed-top">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <img src="images/logos/companylogo1.png" height="40"> 
        </a>

        <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="./">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="./about.php">ABOUT</a></li>

                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">BRANDS</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./brand.php?brand=bugatti">Bugatti</a>
                            <a class="dropdown-item" href="./brand.php?brand=jaguar">Jaguar</a>
                            <a class="dropdown-item" href="./brand.php?brand=mclaren">Mclaren</a>
                            <a class="dropdown-item" href="./brand.php?brand=koenigsegg">Koenigsegg</a>
                            <a class="dropdown-item" href="./brand.php?brand=lamborghini">lamborghini</a>
                            <a class="dropdown-item" href="./brand.php?brand=bentley">Bentley</a>
                            <a class="dropdown-item" href="./brand.php?brand=astonmartin">Aston Martin</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="./reviews.php">REVIEWS</a></li>
                </ul>

                <?php
                    //sesion magic
                    session_start();
                    if (isset($_SESSION['memberid'])) {
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><?php echo $_SESSION['name']?></a>
                                <div class="dropdown-menu">
                                    <?php
                                        if(isset($_SESSION['memberid']) && $_SESSION['isAdmin']) {
                                            ?>
                                            <a class="dropdown-item" href="./admin.php">Admin Panel</a>
                                            <?php
                                        }
                                    ?>
                                    <a class="dropdown-item" href="./account.php">View Profile</a>
                                    <a class="dropdown-item" href="./cart.php">Cart</a>
                                    <a class="dropdown-item" href="./checkout.php">Checkout</a>
                                    <a class="dropdown-item" href="./logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>



                    <?php
                    }
                    else {
                        ?>
                        <span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./login.php">Login</a></span>
                        <?php
                    }
                ?>

                
                
        </div>
    </div>

    <!-- <div class="dd link">
                                <a href="#"><?php //echo $_SESSION['name']?></a>
                                <div class="dd-content">
                                    <a href="./account.php">View Profile</a>
                                    
                                    <a href="./checkout.php">Checkout</a>
                                    <a href="./logout.php">Logout</a>
                                </div>
                            </div> -->
    

    <!-- <ul class="links">
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
        
    </ul> -->
</nav>
<div class="bg"></div>
