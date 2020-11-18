<?php
$first_name = $last_name = $email = $password_hashed = $errorMsg = "";
$success = true;

// Only process if the form has been submitted via POST.
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   // First Name
    if (!empty($_POST["first_name"]))
    {
        $first_name = sanitize_input($_POST["first_name"]);
    }
    
    // Last Name
    if (empty($_POST["last_name"]))
    {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    }
    else 
    {
        $last_name = sanitize_input($_POST["last_name"]);
    }
    
   // Email Address
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
    
    // Password
    if (empty($_POST["password"]) || empty($_POST["password_confirm"]))
    {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    }
    else 
    {
        // Make sure passwords match
        if ($_POST["password"] != $_POST["password_confirm"])
        {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        }
        else
        {
            $password_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
    }
    if ($success)
    {
     
    }
}
else 
{
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='register.php'>Go to Sign Up page...</a>";
    exit();
}

function sanitize_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}
?>
<?php
function saveMemberToDB()
{
    global $first_name, $last_name, $email, $password_hashed, $errorMsg, $success;
    // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
        // Prepare the statement:
        $stmt = $conn->prepare("INSERT INTO members (first_name, last_name,
       email, password) VALUES (?, ?, ?, ?)");
        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password_hashed);
    if (!$stmt->execute())
    {
        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $success = false;
    }
    $stmt->close();
    }
    $conn->close();
   }
?>
 <?php
        if (saveMemberToDB()){
         $success = false;
        }
        else
        {
            $success = true;
        }
        
        if ($success)
        {
            
            echo "<h2>Your registration is successful!</h2>";
            echo "<h4>Thank you for signing up, " . $first_name . " " . $last_name . ".</h4>";
            echo "<a href='login.php' class='btn btn-success'>Log-in</a>";
        }
        else 
        {
            echo "<h2>Oops!</h2>";
            echo "<h4>The following errors were detected:</h4>";
            echo "<p>" . $errorMsg . "</p>";
            echo "<a href='register.php'g class='btn btn-danger'>Return to Sign Up</a>";
        }
        ?>
