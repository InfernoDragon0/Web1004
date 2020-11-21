<html lang="en">
    <head>
        <title>Review</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                class=""accesskey=""rel="stylesheet">
        <link rel="stylesheet" href="css/reviewpage.css">
    </head>
    <body>
        <main>
            <h3>Reviews</h3>
            <?php
                session_start();
                $review = $errormsg = "";
                $success = true;
                // Get member's id from session
                $member_id = $_SESSION['id'] = 1;

                global $member_id, $review, $error_msg, $success; 

                // Create database connection
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                
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
                            {
                                ?>
                                <form action="editreview.php" method="GET">
                                    <input type="hidden" name="review_id" value="<?php echo $rows['id'];?>"> 
                                    <button class="editreviewbutton">
                                        <span class="material-icons">
                                            create
                                        </span>
                                    </button>
                                </form>
                                <form action="deletereview.php" method="GET">
                                    <input type="hidden" name="review_id" value="<?php echo $rows['id'];?>">
                                    <button class="deletereviewbutton">
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
                            <form action="addcomment.php" method="GET">
                                <input type="hidden" name="review_id" value="<?php echo $rows['id']; ?>">
                                <button class="addcommentbutton">
                                    <span class="material-icons">
                                        add
                                    </span>
                                </button>
                            </form>
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
            ?>

            <div>
                <a href="addreview.php" class="addreviewbutton">
                <span class="material-icons">
                    add
                </span>
                </a>
            </div>
        </main>
    </body>
</html>
