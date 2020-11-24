<?php

$cartid = $_POST["cartid"];
$carid = $_POST["carid"];
$qty = $_POST["carid"];
if (isset($_SESSION['memberid'])) {
    $memberid = $_SESSION['memberid']; //for later use
} else {
    //Redirect to login page first
    //return
}
helloDb();

function helloDb() {
    global $car;

    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        echo $errorMsg;
        $success = false;
    } else {
        $stmt = $conn->prepare("UPDATE cart SET  qty = ? WHERE id= ? AND car_id=? AND member_id=? ");
        $stmt->bind_param("iiii",$qty, $cartid, $carid,$memberid);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); //not a while loop cos should only take one car 

        $stmt->close();
        header("location:cart.php");
    }
}

?>
