<html lang="en">
    <head>
        <title>Luxauto</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" class=""accesskey=""rel="stylesheet">
        <link rel="stylesheet" href="./css/reviews2.css">
        <?php include './includes/bootstrap-header.php'; ?>
    </head>
    <body>
    <?php include './includes/nav.php'; ?>

    <div>
        <div class="header-blue" style="background: url(&quot;https://i.imgur.com/POvH8Fx.png&quot;);">
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
                <div class="container-fluid"><a class="navbar-brand" href="#">Company Name</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse"
                        id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Dropdown </a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                            </li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" id="search-field" name="search"></div>
                        </form><span class="navbar-text"> <a class="login" href="#">Log In</a></span><a class="btn btn-light action-button" role="button" href="#">Sign Up</a></div>
                </div>
            </nav>
            <div class="container hero">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                        <h1>Let us know</h1>
                        <p>Your Reviews. </p><button class="btn btn-light btn-lg action-button" type="button">Add a Review</button></div>
                    <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder">
                        <div class="phone-mockup">
                            <div class="screen"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">User Reviews</h2>
            </div>
            <div class="row people" style="margin-left: 0px;margin-right: 0px;padding-top: 10px;padding-bottom: 10px;">
                <div class="col-md-6 col-lg-4 item" style="max-width: 100%;margin-right: 10px;margin-left: 10px;min-width: 600px;height: 100%;margin-bottom: 0px;">
                    <div class="box">
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                    </div>
                    <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                        <h5 class="name">Ben Johnson</h5>
                        <p class="title">CEO of Company Inc.</p>
                    </div>
                    <div class="btn-toolbar">
                        <div class="btn-group" role="group"><button class="btn btn-primary" type="button">Add comment</button><button class="btn btn-primary" type="button">Edit Review</button></div>
                        <div class="btn-group" role="group"><button class="btn btn-primary" type="button">Delete Review</button></div>
                    </div>
                    <hr>
                    <div class="box">
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                        <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                            <h5 class="name">Comment guy</h5>
                            <p class="title">Commenting</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                        <h5 class="name">Ben Johnson</h5>
                        <p class="title">CEO of Company Inc.</p>
                    </div>
                </div>
            </div>
            <div class="row people" style="margin-left: 0px;margin-right: 0px;padding-top: 10px;padding-bottom: 10px;">
                <div class="col">
                    <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                        <h5 class="name">Ben Johnson</h5>
                        <p class="title">CEO of Company Inc.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item" style="max-width: 100%;margin-right: 10px;margin-left: 10px;min-width: 600px;height: 100%;margin-bottom: 0px;">
                    <div class="box">
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                    </div>
                    <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                        <h5 class="name">Ben Johnson</h5>
                        <p class="title">CEO of Company Inc.</p>
                    </div>
                    <div class="btn-toolbar">
                        <div class="btn-group" role="group"><button class="btn btn-primary" type="button">Add comment</button><button class="btn btn-primary" type="button">Edit Review</button></div>
                        <div class="btn-group" role="group"><button class="btn btn-primary" type="button">Delete Review</button></div>
                    </div>
                    <hr>
                    <div class="box">
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                        <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                            <h5 class="name">Comment guy</h5>
                            <p class="title">Commenting</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "./includes/footer.php"; ?>
    </body>
</html>