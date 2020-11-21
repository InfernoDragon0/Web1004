
<?php
        $email = $first_name = $last_name = $password_hashed = $errorMsg = $errorMsg1 = "";
        $success = true;
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            //email    
            if (empty($_POST["email"]))
            {
                $errorMsg .= "Email is required.<br>";
                $success = false;
            }
            else
            {
                $email = sanitize_input($_POST["email"]);
                // Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $errorMsg .= "Invalid email format.";
                    $success = false;
                }  
            }
            if  (empty($_POST["password"]))
            {
                $errorMsg .= "Password and confirmation are required.";
                $success=false;
            }    
            //input valid, query to DB if email/pwd match
            if ($success)
            {
                authenticateUser();
            }
        }
        else
        {
            echo"<h2>This page is not meant to be run directly.</2>";
        }
        
        
        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        /*
        * Helper function to authenticate the login.
        */
        function authenticateUser()
        {
            global $first_name, $last_name, $email, $password_hashed, $errorMsg, $success;
            // Create database connection.
            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'project1004');
            // Check connection
            if ($conn->connect_error)
            {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            }
            else
            {
                // Prepare the statement:
                $stmt = $conn->prepare("SELECT * FROM members WHERE email=?");
                // Bind & execute the query statement:
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0)
                {
                    // Note that email field is unique, so should only have
                    // one row in the result set.
                    $row = $result->fetch_assoc();
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $password_hashed = $row["password"];
                    // Check if the password matches:
                    if (!password_verify($_POST["password"], $password_hashed))
                    {
                        $errorMsg = "Email not found or password doesn't match...";
                        $success = false;
                    }
                }
                else
                {
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;
                }
                $stmt->close();
                }
            $conn->close();
        }
        ?>
            <?php
            if ($success)
            {   session_start();
                $_SESSION['email']=$email;
                echo"<h2>Login successful!</h2>";
                echo"<h4>Welcome back again, " . $first_name . " " . $last_name . ".</h4>";
                echo"<a href='index.php' class='btn btn-success'>Return to Home</a>";
                echo"<a href='logout.php' class='btn btn-success'>Logout</a>";
            }
            else
            {
                echo"<h2>Oops!</h2>";
                echo"<h2>testing</h2>";
                echo"<h4>The following errors were detected:</h4>";
                echo"<p>" . $errorMsg . "</p>";
                echo"<a href='login.php' class='btn btn-warning' type>Return to Login</a>";
            }    
            ?>
