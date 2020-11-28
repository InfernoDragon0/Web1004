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
    
    
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
 
   
    <p>Your order history:</p>
    <div class="orderhistory">
        <?php
            //order history READ
            session_start();
            $memberid = 1; //debug only
            if (isset($_SESSION['memberid'])) {
                $memberid = $_SESSION['memberid']; //for later use
            }
            else {
                echo "<meta http-equiv='refresh' content='0;url=./login.php'>";
                return;
            }

            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                echo $errorMsg;
                $success = false;
            } 
            else {

                //$stmt = $conn->prepare("SELECT * FROM orders os, order_details ods where member_id = ? and os.id = ods.order_id");
                //select id, chargeid, transaction date and count the number of cars in the order, groupby to allow count()
                $stmt = $conn->prepare("SELECT os.id, charge_id, transaction_date, saleStatus, count(car_id) cars FROM orders os, order_detail od where member_id = ? and os.id = od.order_id group by os.id");
                $stmt->bind_param("i", $memberid);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()) {
                    //$carid = $row["car_id"];
                    //$qty = $row["qty"];

                    //only need to show the order ids
                    $orderid = $row["id"];
                    $tdate = $row["transaction_date"];
                    $chargeid = $row["charge_id"];
                    $salestatus = $row["saleStatus"];
                    $totalCars = $row["cars"]; //count(car_id) cars

                    //write html here
                    ?>
                        <div class="orderdetails">
                        <p>ID: <?php echo $orderid?></p>
                        <p>Transaction Date: <?php echo $tdate?></p>
                        <p>Charge ID: <?php echo $chargeid?></p>
                        <p>Status: <?php echo $salestatus?></p>
                        <p>Number of Cars: <?php echo $totalCars?></p>
                        </div>
                        

                    <?php

                }
            }
            
            //order history DELETE
        ?>

</div>

   
<div class="auth">
        <img src="./images/hd/cat1.png"/>
        <div id="login" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">Login to view/edit profile</p>
                <form action="LoginProcess1.php<?php echo $redirector;?>" method="post">
                <input type="email" class="inputs" name="email" required placeholder="Email"/>
                <input type="password" class="inputs" name="password" required placeholder="Password"/><br>
                <br><br>
                <button class="auth-submit">Login</button><br>
                </form>
        </div>

</body>

</html>