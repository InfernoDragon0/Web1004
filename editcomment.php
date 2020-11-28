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
            <?php
                include './includes/nav.php';
                session_start();
                $comment_id = $_GET['comment_id'];
                //echo $review_id;
                global $member_id, $comment_id, $comment, $error_msg, $success; 

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
                $stmt = $conn -> prepare("SELECT * FROM comments WHERE id=?");
                // Bind & execute the query statement
                $stmt ->bind_param("s", $comment_id);
                $stmt -> execute();
                $result = $stmt ->get_result();
                if ($result -> num_rows > 0)
                {
                    $row = $result ->fetch_assoc();
                    $comment = $row['comment'];
                }
             ?>
             <h3>Edit Comment</h3>
             <form action="" method="POST">
                <label>Edit comment:</label><br>
                <textarea type="text" id="comment" name="comment"><?php echo $comment;?></textarea>
                <button type="submit" id="post">
                    <span class="material-icons">send</span>
                </button>
             </form>
             <?php
                if (!empty($_POST['comment']))
                {
                    $comment = sanitize_input($_POST['comment']);
                    updatecommenttodb();
                }

                function sanitize_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                function updatecommenttodb()
                {
                    $comment = $errormsg = "";
                    $success = true;

                    global $member_id, $comment_id, $comment, $error_msg, $success; 

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
                        $stmt = $conn -> prepare("UPDATE comments SET comment = ?, date_time = ?  WHERE id= ?");
                        
                        // Bind & execute the query statement
                        $stmt -> bind_param("sss", $comment, $datetime, $comment_id);
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
