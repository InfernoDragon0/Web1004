<html lang="en">
    <head>
    <meta charset="UTF-8">
        <?php
            include "./includes/header.php"
        ?>
</head>
<body>
    <?php
        include "./includes/nav.php"
    ?>
    <br>
    <br>
    <br>
    <br>
<?php
$first_name = $last_name = $email = $password_hashed = $errorMsg = "";
$success = true;

// Only process if the form has been submitted via POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // First Name
    if (isset($_POST["first_name"])) {
        $first_name = sanitize_input($_POST["first_name"]);
    }
    else {
        $errorMsg .= "First name is required.<br>";
        $success = false;
    }
    
    // Last Name
    if (isset($_POST["last_name"])) {
        $last_name = sanitize_input($_POST["last_name"]);
      
    }
    else {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    }
    
   // Email Address
    if (isset($_POST["email"])) {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
        
    }
    else {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    }
    
    // Password
    if (isset($_POST["password"]) || isset($_POST["password_confirm"])) {
        // Make sure passwords match
        if ($_POST["password"] != $_POST["password_confirm"]) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        }
        else {
            $password_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
    }
    else 
    {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    }
    if (!$success) {
        echo "<p>errors occurred<p><br> " . $errorMsg;
    }
    else {
$res = UpdateMemberToDB();

    }
}
else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='register.php'>Go to Sign Up page...</a>";
    exit();
}

function sanitize_input($data) {
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}

function UpdateMemberToDB() {
    global $first_name, $last_name, $email, $password_hashed, $errorMsg, $id;
    // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'project1004');
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $result = 0;
    }
    else
    {   
        $id = $_SESSION['memberid'] ;
       
        $stmt = $conn->prepare("UPDATE members SET first_name= ? , last_name= ? ,email= ?,"
                . " password= ?  WHERE member_id = ? ");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $password_hashed, $id);
        $stmt->execute();
        $result = 1;
        $stmt->close();
    }
    $conn->close();
    return $result;
}


if (!$res) {
    echo "<h2><p>Oops!<p></h2>";
    echo "<h4><p>The following errors were detected:<p></h4>";
    echo "<p>$errorMsg</p>";
    echo "<a href='account.php'g class='btn btn-danger'>Return to profile page</a>";
}
else
{
    echo "<h2><p>Your update is successful!</p></h2>";
    echo "<h4><p>Please login again, $first_name $last_name</p></h4>";
    echo "<a href='login.php' class='btn btn-success'>Log-in</a>";
    echo "<p>Your account ID is $id</p>";
    session_destroy();
}

?>
</body>
</html>