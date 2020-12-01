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
            
            <div class="container hero">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                        <h1>Let us know</h1>
                        <p>Your Reviews. </p><a href="addreview.php"><button class="btn btn-light btn-lg action-button" type="button">Add a Review</button></a></div>
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


            <?php
                session_start();
                $review = $errormsg = "";
                $success = true;
                // Get member's id from session
                $member_id = $_SESSION['id'] = 1;

                global $member_id, $review, $error_msg, $success; 

                // Create database connection
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'project1004');
                
                // Check connection
                if ($conn -> connect_error)
                {
                    $errorMsg = "Connection failed: " . $conn -> connect_error;
                    $success = false;
                }

                // Prepare the statement
                //date_default_timezone_set('Asia/Singapore');
                $stmt = $conn -> prepare("SELECT * FROM reviews");
                
                // Bind & execute the query statement
                $stmt->execute();
                $result = $stmt->get_result();
                //$sql = "SELECT * FROM reviews";
                //$result = $conn->query($sql);

                if($result->num_rows > 0)
                {
                    //$row = $result->fetch_assoc();
                    //$review_id = $row['id'];
                    //$member_id = $row['member_id'];
                    //$review = $row['review'];
                    //$datetime = $row['date_time'];
                    while ($rows = $result->fetch_assoc())
                    {
                        ?>
                        <div class="review-container">
                            <h4><?php echo $rows['review']; ?></h4>
                            <small><?php echo $rows['date_time'];  ?></small>
                            <?php 
                                $statement = $conn -> prepare("SELECT * FROM comments WHERE review_id=?");
                                $statement->bind_param("s", $rows['id']);
                                $statement->execute();
                                $stresult = $statement->get_result();
                                if($stresult->num_rows > 0)
                                {
                                    while ($strows = $stresult->fetch_assoc())
                                    {
                                        ?>
                                        <div class="comments-container">
                                            <div class="comment-container">
                                                <h4><?php echo $strows['comment'];?></h4>
                                                <small><?php echo $strows['date_time'];  ?></small>
                                                <?php
                                                    if($member_id == $strows['member_id'])
                                                    {
                                                        ?>
                                                        <form action="editcomment.php" method="GET">
                                                            <input type="hidden" name="comment_id" value="<?php echo $strows['id'];?>"> 
                                                            <button class="editcommentbutton">
                                                                <span class="material-icons">
                                                                    create
                                                                </span>
                                                            </button>
                                                        </form>
                                                        <form action="deletecomment.php" method="GET">
                                                            <input type="hidden" name="comment_id" value="<?php echo $strows['id'];?>">
                                                            <button class="deletecommentbutton">
                                                                <span class="material-icons">
                                                                    delete_sweep
                                                                </span>
                                                            </button>
                                                        </form>
                                                        <?php
                                                        }
                            
                                                        else
                                                        {
                            
                                                        }
                                                        ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }

                            if($member_id == $rows['member_id'])
                            { //buttons are done
                                ?>
                                <div class="btn-toolbar">
                        
                                <div class="btn-group" role="group"></div>
                    
                                <form action="editreview.php" method="GET">
                                    <input type="hidden" name="review_id" value="<?php echo $rows['id'];?>"> 
                                    <button class="btn btn-primary" type="button">Edit Review</button>
                                </form>
                                <form action="deletereview.php" method="GET">
                                    <input type="hidden" name="review_id" value="<?php echo $rows['id'];?>">
                                    <button class="btn btn-primary" type="button">Delete Review</button>
                                </form>
                                
                                <?php
                            }
                        
                            if($member_id != NULL)
                            {
                            ?>
                                <form action="addcomment.php" method="GET">
                                    <input type="hidden" name="review_id" value="<?php echo $rows['id']; ?>">
                                    <button class="btn btn-primary" type="button">Add comment</button>
                                </form>
                            </div>
                            <?php
                            }
                            else {
                                ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div></br>
                    <?php
                    }
                }
                else
                {
                    ?>
                    <h4>There is no reviews yet.</h4>
                    <?php
                }
                
                $conn->close();
            if($member_id != NULL)
            {
            ?>

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