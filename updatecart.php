<?php

echo $cartid = $_POST["cartid"];
echo $carid = $_POST["carid"];
echo $qty = $_POST["qty"];
$userid = 19;
//        if (isset($_SESSION['id'])) {
//            echo $userid = $_SESSION['id'];
//        }       
//        else{
//            header("Location:login.php");
//            
//        }
//helloDb();

function helloDb() {
    global $car;

    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        echo $errorMsg;
        $success = false;
    } else {
        $stmt = $conn->prepare("UPDATE cart SET  qty = ? WHERE id= ? ");
        $stmt->bind_param("ii",$qty, $cartid);
        $stmt->execute();

        header("Location:cart.php");

        $stmt->close();
    }
}

?>
