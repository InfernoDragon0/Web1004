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
            <h3>Add Comment</h3>
            <form action="" method="POST">
                <label>Please leave your comment:</label></br>
                <textarea type="text" id="comment" name="comment" placeholder="Please type in your comment here..."></textarea>
                <button type="submit" id="post">
                    <span class="material-icons">send</span>
                </button>
            </form>
            <?php
                session_start();
                $review_id = $_GET['review_id'];
                // Get member's id from session
                $member_id = $_SESSION['id'] = 1;
                //echo $member_id;

                if (!empty($_POST['comment']))
                {
                    $comment = sanitize_input($_POST['comment']);
                    savecommenttodb();
                }

                function sanitize_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                
                function savecommenttodb()
                {
                    $review = $errormsg = "";
                    $success = true;

                    global $member_id, $review_id, $comment, $error_msg, $success; 

                    // Create database connection
                    $config = parse_ini_file('../../private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                    
                    // Check connection
                    if ($conn -> connect_error)
                    {
                        $errorMsg = "Connection failed: " . $conn -> connect_error;
                        $success = false;
                    }
    
                    else
                    {
                        // Prepare the statement
                        date_default_timezone_set('Asia/Singapore');
                        $datetime = date("Y-m-d H:i:s");
                        $stmt = $conn -> prepare("INSERT INTO comments (review_id, member_id, comment, date_time) VALUES (?, ?, ?, ?)");
                        
                        // Bind & execute the query statement
                        $stmt -> bind_param("ssss", $review_id, $member_id, $comment, $datetime);
                        if(!$stmt)
                        {
                            echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
                        }
                        $stmt->execute();
                    }
                    echo '<script>window.location.href = "reviews.php";</script>';
                }
            ?>
        </main>
    </body>
</html>
