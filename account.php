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
    
    <p> </p>
    <p> </p>
    <p> </p>
<!--  extra 3x <p> </p>  to insert extra spaces, ensure navbar doesnt block contents-->
    
    <p>Account details here</p>
    <p>Your name: abc</p>
    <p>Your email address:</p>
    <p>Your profile pic here</p>
    <p>reset password?</p>
    <p>email verification?</p>
    <p>Your order history:</p>
    
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    
   
    
    <div id="update" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">Update Account</p>
                <form action="UpdateProcess.php" method="post">
                    <input type="text" class="inputs" required placeholder="First Name" value="default value" name="first_name"/>
                    <input type="text" class="inputs" required placeholder="Last Name" value="default value" name="last_name"/>
                    <input type="email" class="inputs" required placeholder="Email Address" value="default value" name="email"/>
                    <input type="password" class="inputs" required placeholder="Password" value="default value" name="password"/>
                    <input type="password" class="inputs" required placeholder="Re-Password" value="default value" name="password_confirm"/><br>
                    <br><br>
                    <button class="auth-submit">Update</button><br>
                    <hr>
                </form>
        </div>

<?php
    //order history READ
    $memberid = 1; //debug only
    $orderData = [];
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
        $stmt = $conn->prepare("SELECT * FROM orders os, order_details ods where member_id = ? and os.id = ods.order_id");
        $stmt->bind_param("i", $memberid);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            $carid = $row["car_id"];
            $qty = $row["qty"];

            $orderid = $row["order_id"];
            $tdate = $row["transaction_date"];
            $chargeid = $row["charge_id"];
            $salestatus = $row["saleStatus"];

            //add these to a json array then show on display?

        }
    }
    
    //order history DELETE
?>

</body>

</html>