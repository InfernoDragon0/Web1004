<?php

$cartidToDelete = $_POST["cartid"];
$caridToDelete = $_POST["carid"];
if (isset($_SESSION['memberid'])) {
    $memberid = $_SESSION['memberid']; //for later use
} else {
    //Redirect to login page first
    //return
}
helloDb();

function helloDb() {
    global $cartidToDelete, $caridToDelete, $memberid;

    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        echo $errorMsg;
        $success = false;
    } else {
        $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND car_id = ? AND member_id = ?");
        $stmt->bind_param("iii", $cartidToDelete, $caridToDelete,$memberid);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        header("location:cart.php");
    }
}

?>
