<?php

$aType = $POST['auth']; //Register or Login or Logout

switch ($aType) {
    case 'register':
$email = $errorMsg = $fname = $lname = $pwhash = "";
$success = true;

if (empty($_POST["fname"]))
{
    $fname = sanitize_input($_POST["fname"]);
}

if (empty($_POST["lname"]))
{
    $errorMsg .= "Last name is required.<br>";
    $success = false;
}
else
{
    $lname = sanitize_input($_POST["lname"]);
}

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
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

if (empty($_POST["pw"]) or empty($_POST["pw_confirm"]))
{
    $errorMsg .= "Both passwords are required.<br>";
    $success = false;
}
else
{
    if ($_POST["pw"] != $_POST["pw_confirm"])
    {
        $errorMsg .= "Passwords do not match.<br>";
        $success = false;
    }
    else
    {
        $pwhash = password_hash($_POST["pw"], PASSWORD_DEFAULT);
    }
}

if($success)
{
    saveMemberToDB();
}

if ($success)

            {
                echo "<h2>Your registration is successful!</h2>";
                echo "<h4>Thank you for signing up, ".htmlspecialchars($_POST["lname"]). "</h4>";
                echo "<h4>Please verify by clicking the activation link sent to your email. </h4>";
                echo "<a class='btn btn-success' href='login.php' role='button'>Log-in</a>";
                echo "<br><br>";
            }
            else
            {
                echo "<h2>Oops!</h2>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a class='btn btn-danger' href='register.php' role='button'>Return to Sign Up</a>";
                echo "<br><br>";
            }
            
        break;
    case 'login':
        //do login, maybe 2fa here
        break;
    case 'logout':
        //clear session
        break;
}
?>

<?php
//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}
?>

<?php

/*
* Helper function to write the member data to the DB
*/
function saveMemberToDB()
{
    global $fname, $lname, $email, $pwhash, $errorMsg, $success;
    
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
        $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");

        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $fname, $lname, $email, $pwhash);
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