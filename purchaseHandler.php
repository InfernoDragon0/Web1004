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
    <br>
    <br>
    <br>


    <?php
        $memberid = 1; //debug only
        $chargeid = "Randoomid"; //add payment gateway id here

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
            $stmt = $conn->prepare("SELECT * FROM cart where member_id = ?");
            $stmt->bind_param("i", $memberid);
            $stmt->execute();
            $result = $stmt->get_result();

            //echo $result->num_rows;
            if ($result->num_rows > 0) {

                $curdate = date("Y-m-d");

                //create sale in ORDERS table
                $stmt3 = $conn->prepare("INSERT INTO orders (member_id, charge_id, transaction_date) VALUES (?, ?, ?)");
                $stmt3->bind_param("iss", $memberid, $chargeid, $curdate);
                $check = $stmt3->execute();
                $orderID = $conn->insert_id;
                

                while($row = $result->fetch_assoc()) {
                    $carId = $row["car_id"];
                    $qty = $row["qty"];

                    //the less efficient way for now
                    //should convert to bulk insert?
                    $stmt2 = $conn->prepare("INSERT INTO order_detail (order_id, car_id, qty) VALUES (?, ?, ?)");
                    $stmt2->bind_param("iii", $orderID, $carId, $qty);
                    $stmt2->execute();
                    $result2 = $conn->insert_id;
                }

                

                if ($check) {
                    //delete from cart after completion
                    $stmt = $conn->prepare("DELETE FROM cart where member_id = ?");
                    $stmt->bind_param("i", $memberid);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    ?>

                    <div class="page-header">
                        <h1>Order Successful</h1>
                        <h2>Thank you for your purchase!</h2>
                        <p>You will receive an invoice via your registered email. You may also check your order status in your profile</p>
                        <p>Order ID: #<?php echo $orderID; ?></p>
                    </div>

                    <?php
                }

                else {
                    ?>

                    <div class="page-header">
                        <h1>Order Failed</h1>
                        <h2>Please try again!</h2>
                        <p>There was an error processing your order, please try again. If this persists, please contact our customer service!</p>
                    </div>

                    <?php
                }
            }
            else {
                ?>

                    <div class="page-header">
                        <h1>Order Failed</h1>
                        <h2>Your Cart is empty!</h2>
                        <p>There was an error processing your order, please try again. If this persists, please contact our customer service!</p>
                    </div>

                    <?php
            }
        }

    ?>


</body>

</html>

