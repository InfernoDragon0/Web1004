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
                $member_id = $_SESSION['memberid'];

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
                        <div class="row people" style="margin-left: 0px;margin-right: 0px;padding-top: 10px;padding-bottom: 10px;">
                            <div class="col-md-6 col-lg-4 item" style="max-width: 100%;margin-right: 10px;margin-left: 10px;min-width: 100%;height: 100%;margin-bottom: 0px;">
                                <div class="box">
                                    <p class="description"><?php echo $rows['review']; ?></p>
                                </div>
                                <div class="author"><img class="rounded-circle" src="./images/logos/cat.gif">
                                    <h5 class="name">Anonymous Member</h5>
                                    <p class="title">Reviewed at <?php echo $rows['date_time']; ?></p>
                                </div>
                                
                            <?php 

                            
                                if($member_id != null) {
                                    ?>
                                    <div class="btn-toolbar">
                                    
                                    <form action="addcomment.php" method="GET">
                                        <input type="hidden" name="review_id" value="<?php echo $rows['id']; ?>">
                                        <button class="btn btn-primary" type="submit">Add comment</button>
                                    </form>
                                    <?php

                                    if ($member_id == $rows['member_id']) { //buttons are done
                                        ?>
                                        <form action="editreview.php" method="GET">
                                            <input type="hidden" name="review_id" value="<?php echo $rows['id'];?>"> 
                                            <button class="btn btn-primary" type="submit">Edit Review</button>
                                        </form>
                                        <form action="deletereview.php" method="GET">
                                            <input type="hidden" name="review_id" value="<?php echo $rows['id'];?>">
                                            <button class="btn btn-primary" type="submit">Delete Review</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <hr>

                                    <?php
                                }

                                $statement = $conn -> prepare("SELECT * FROM comments WHERE review_id=?");
                                $statement->bind_param("s", $rows['id']);
                                $statement->execute();
                                $stresult = $statement->get_result();
                                if($stresult->num_rows > 0)
                                {
                                    while ($strows = $stresult->fetch_assoc())
                                    {
                                        ?>
                                        <div class="box">
                                            <p class="description"><?php echo $strows['comment'];?></p>
                                            <div class="author"><img class="rounded-circle" src="./images/logos/cat.gif">
                                                <h5 class="name">Anonymous Member</h5>
                                                <p class="title">Commented on <?php echo $strows['date_time'];?></p>
                                            </div>
                                        </div>
                                            

                                    <?php
                                        if($member_id == $strows['member_id']) {
                                            ?>
                                                <form action="editcomment.php" method="GET">
                                                <input type="hidden" name="comment_id" value="<?php echo $strows['id'];?>">
                                                <button class="btn btn-primary" type="submit">Edit Comment</button>
                                            </form>
                                            <form action="deletecomment.php" method="GET">
                                                <input type="hidden" name="comment_id" value="<?php echo $strows['id'];?>">
                                                <button class="btn btn-primary" type="submit">Delete Comment</button>
                                            </form>
                                            <?php
                                        }
                                    }
                                }?>
                            </div>
                            <div class="col">
                                <!-- <div class="author"><img class="rounded-circle" src="assets/img/cat.gif">
                                    <h5 class="name">Ben Johnson</h5>
                                    <p class="title">CEO of Company Inc.</p>
                                </div> -->
                            </div>
                        </div>
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
            ?>
        </div>
    </div>

    <?php include "./includes/footer.php"; ?>
    </body>
</html>