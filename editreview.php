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
            <?php
                session_start();
                $review_id = $_GET['review_id'];
                //echo $review_id;
                global $member_id, $review_id, $review, $error_msg, $success; 

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
                $stmt = $conn -> prepare("SELECT * FROM reviews WHERE id=?");
                // Bind & execute the query statement
                $stmt ->bind_param("s", $review_id);
                $stmt -> execute();
                $result = $stmt ->get_result();
                if ($result -> num_rows > 0)
                {
                    $row = $result ->fetch_assoc();
                    $review = $row['review'];
                }
             ?>
             <h3>Edit Review</h3>
             <form action="" method="POST">
                <label>Edit review:</label><br>
                <textarea type="text" id="review" name="review"><?php echo $review;?></textarea>
                <button type="submit" id="post">
                    <span class="material-icons">send</span>
                </button>
             </form>
             <?php
                if (!empty($_POST['review']))
                {
                    $review = sanitize_input($_POST['review']);
                    updatereviewtodb();
                }

                function sanitize_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                function updatereviewtodb()
                {
                    $review = $errormsg = "";
                    $success = true;

                    global $member_id, $review_id, $review, $error_msg, $success; 

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
                        $stmt = $conn -> prepare("UPDATE reviews SET review = '$review', date_time = '$datetime'  WHERE id= '$review_id'");
                        
                        // Bind & execute the query statement
                        //$stmt -> bind_param("sss", $review, $datetime, $review_id);
                        if(!$stmt)
                        {
                            echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
                        }
                        $stmt->execute();
                        echo '<script>window.location.href = "reviews.php";</script>';
                    }
                }
             ?>
        </main>
    </body>
</html>
