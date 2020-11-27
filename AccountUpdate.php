<html>
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
     <?php       
    if (isset($_SESSION['memberid'])) {
        $memberid = $_SESSION['memberid']; //for later use
    }
    else {
        //Redirect to login page first
        //return
    }

    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        echo $errorMsg;
        $success = false;
    } 
    else {
        $stmt = $conn->prepare("SELECT * FROM members where member_id = ?");
        $stmt->bind_param("i", $memberid);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            
            
            

            //add these to a json array then show on display?

        }
    }
    ?>
    <?php
    $email = $_SESSION['email'];
   ?>
         
                 
<div id="update" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">Update Account</p>
                <form action="UpdateProcess.php" method="post">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="inputs" required placeholder="First Name" value= "<?php echo $first_name;?>" name="first_name"/>
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="inputs" required placeholder="Last Name" value="<?php echo $last_name;?>" name="last_name"/>
                    <label for="email">Email:</label>
                    <input type="email" class="inputs" required placeholder="Email Address" value="<?php echo $email;?>" name="email"/>
                    <label for="password">Password:</label>
                    <input type="password" class="inputs" required placeholder="Password"  name="password"/>
                    <label for="password_confirm">Re-enter Password:</label>
                    <input type="password" class="inputs" required placeholder="Re-enter Password"  name="password_confirm"/><br>
                    <button class="auth-submit">Update</button><br>
                    <hr>
                </form>
        </div>

</body>

</html>
