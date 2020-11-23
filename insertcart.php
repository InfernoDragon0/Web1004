
<?php

$car = $_POST['carid'];
$qty = $_POST['qty'];

    if (isset($_SESSION['memberid'])) {
        $userid = $_SESSION['memberid'];
        $username = $_SESSION['membername'];
        echo $userid;
    }
helloDb();
function saveCartToDB() {
    global $car, $qty, $userid;
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
        $stmt = $conn->prepare("INSERT INTO cart (member_id, car_id, qty) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userid, $car, $qty);
        $stmt->execute();

        $result = $conn->insert_id;

        if (!$result)
        {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $result = 0;
        }

        $stmt->close();
    }
    $conn->close();
    return $result;
}
//function helloDb() {
//    global $car;
//
//    $config = parse_ini_file('../../private/db-config.ini');
//    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

//
//    if ($conn->connect_error) {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//        echo $errorMsg;
//        $success = false;
//    } else {
//        $stmtinsert = $conn->prepare("INSERT INTO cart(member_id,car_id,qty) VALUES('?','?','?')");
//
//        $stmtinsert->bind_param("iii", $car, $qty, $userid);
//        $stmtinsert->execute();
//       $result = $conn->insert_id;
//
//        if (!$result)
//        {
//            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//            $result = 0;
//        }
//         else {
//
//            header("Location:cart.php");
//        }
//        $stmt->close();
//    }
//}

?>
