<html lang="en">
    <head>
        <title>Luxauto</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                class=""accesskey=""rel="stylesheet">
        <link rel="stylesheet" href="css/reviewpage.css">
        <?php include './includes/header.php'; ?>
    </head>
    <body>
        <main>
            <?php include './includes/nav.php'; ?>
            <h3>Add Review</h3>
            <form action="" method="POST">
                <label>Please leave a review:</label></br>
                <textarea type="text" id="review" name="review" placeholder="Please type in your review here..."></textarea>
                <button type="submit" id="post">
                    <span class="material-icons">send</span>
                </button>
            </form>
            <?php
                session_start();
                // Get member's id from session
                $member_id = $_SESSION['memberid'];
                //echo $member_id;
                if (isset($_SESSION['memberid'])) {
                    $memberid = $_SESSION['memberid'];
                }
                else {
                    header("Location: ./login.php?rd=review"); //header wont work because bootstrap is bad bad
                    echo "<meta http-equiv='refresh' content='0;url=./login.php?rd=review'>";

                    return;
                }

                if (!empty($_POST['review']))
                {
                    $review = sanitize_input($_POST['review']);
                    savereviewtodb();
                }

                function sanitize_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                
                function savereviewtodb()
                {
                    $review = $errormsg = "";
                    $success = true;

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
    
                    else
                    {
                        // Prepare the statement
                        date_default_timezone_set('Asia/Singapore');
                        $datetime = date("Y-m-d H:i:s");
                        $stmt = $conn -> prepare("INSERT INTO reviews (member_id, review, date_time) VALUES (?, ?, ?)");
                        
                        // Bind & execute the query statementi
                        $stmt -> bind_param("iss", $member_id, $review, $datetime);
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
        <?php
            include "./includes/footer.php";
        ?>
    </body>
</html>
