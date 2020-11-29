<!DOCTYPE html>
<!-- bootstraping things so stuff have to change -->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
            include "./includes/bootstrap-header.php"
        ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
        <link rel="stylesheet" href="./css/mainv2.css">
    </head>
    <body>
        <?php
            include "./includes/nav.php"
        ?>

        <div class="hero-carousel">
             <video autoplay muted loop id="MainVid">
                <source src="images/Chiron.mp4" type="video/mp4">
            </video>
        </div>

        <div class="d-xl-flex justify-content-xl-center align-items-xl-end" data-bs-parallax-bg="true" style="height: 600px;background-position: center;background-size: cover;">
            <h1>L U X A U T O</h1>
        </div>
        <div class="photo-gallery" style="width: 100%;">
            <div class="container" style="margin-right: 0;margin-left: 0;width: 100%;padding-right: 0;padding-left: 0;max-width: 100%;">
                <div class="intro">
                    <h2 class="text-center">EXOTIC BRANDS.</h2>
                    <p class="text-center">We provide only the best.</p>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-bs-parallax-bg="true" style="background-image: url(./images/hd/astonMain.png);width: 100%; height: 600px;background-position: center;background-size: cover;">
                        </div>
                        <div class="swiper-slide" data-bs-parallax-bg="true" style="background-image: url(./images/hd/huayra.png);width: 100%; height: 600px;background-position: center;background-size: cover;">
                        </div>
                        <div class="swiper-slide" data-bs-parallax-bg="true" style="background-image: url(./images/hd/lamboMain.png);width: 100%; height: 600px;background-position: center;background-size: cover;">
                        </div>
                        <div class="swiper-slide" data-bs-parallax-bg="true" style="background-image: url(./images/hd/koenesiggMain.png);width: 100%; height: 600px;background-position: center;background-size: cover;">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="row photos">
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="./images/hd/cat1.png"><img class="img-fluid" src="./images/hd/cat1.png"></a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="./images/hd/cat2.png"><img class="img-fluid" src="./images/hd/cat2.png"></a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="./images/hd/cat3.png"><img class="img-fluid" src="./images/hd/cat3.png"></a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="./images/hd/cat4.png"><img class="img-fluid" src="./images/hd/cat4.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div data-bs-parallax-bg="true" style="height: 500px;background-image: url(./images/hd/actionBG2.png);background-position: center;background-size: cover;">
            <h1><img src="./images/logos/cat.gif">Weird Car</h1>
        </div>
        <div class="testimonials-clean">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">USER REVIEWS.</h2>
                    <p class="text-center">What our customers say about us.</p>
                </div>
                <div class="row people">
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                        </div>
                        <div class="author"><img class="rounded-circle" src="./images/logos/cat.gif">
                            <h5 class="name">Cat</h5>
                            <p class="title">CEO of Company Inc.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <p class="description">This is a school project btw, not a real web. Do not contact us for car sales.</p>
                        </div>
                        <div class="author"><img class="rounded-circle" src="./images/logos/cat.gif">
                            <h5 class="name">Cart</h5>
                            <p class="title">Founder of Style Co.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <p class="description">Aliquam varius finibus est, et interdum justo suscipit. Vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                        </div>
                        <div class="author"><img class="rounded-circle" src="./images/logos/cat.gif">
                            <h5 class="name">cattttt</h5>
                            <p class="title">Owner of Creative Ltd.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-bs-parallax-bg="true" style="height: 500px;background-image: url(./images/hd/actionBG1.png);background-position: center;background-size: cover;"></div>
        <div class="highlight-clean">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">BE QUICK.</h2>
                    <p class="text-center">Enter now and indulge in the fastest.</p>
                </div>
                <div class="buttons"><a class="btn btn-primary" role="button" href="./login.php">ENTER</a></div>
            </div>
        </div>
    
        <script src="./js/bs-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
        <script src="./js/Simple-Slider.js"></script>

        <?php
            include "./includes/footer.php";
        ?>
    </body>
</html>
