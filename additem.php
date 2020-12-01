<?php

session_start();
$car = $_POST['carid'];
$addqty = $_POST['qty'];
$userid = 19;
additem();

function additem() {
    global $userid, $car, $addqty;
    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'project1004');
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $result = 0;
    } else {
        // check if cart have same car inside
        $stmtcheckcar = $conn->prepare("SELECT *, cart.id as cartid from cart inner join car ON cart.car_id = car.id where member_id = ? and car_id= ?");
        $stmtcheckcar->bind_param("ii", $userid, $car);
        $stmtcheckcar->execute();
        $result = $stmtcheckcar->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $caridincart = $row['car_id'];
                $caridinstore = $row['id'];
                $cartid = $row['cartid'];
                $qty = $row['qty'];
                $stock = $row['stock'];

                if ($caridincart == $caridinstore) {
                    $newqty = $qty + $addqty;
                    echo $newqty < $stock;
                    if ($newqty < $stock) {
                        // if same car is inside update qty
                        $stmtupdate = $conn->prepare("UPDATE cart SET  qty = ? WHERE id= ? ");
                        $stmtupdate->bind_param("ii", $newqty, $cartid);
                        $stmtupdate->execute();


                        if ($stmtupdate >= 1) {
                            echo '<script>window.location.href = "cart.php";</script>';
                        } else {

                            echo "Cannot update qty";
                        }
                    } else {
                        // if qty is greater than stock
                        echo '<script>window.location.href = "cart.php";</script>';
                    }
                }
            }
        } else {
            $stmtinsert = $conn->prepare("INSERT INTO cart(member_id,car_id,qty) VALUES(?,?,?)");
            $stmtinsert->bind_param("iii", $userid, $car, $addqty);
            $stmtinsert->execute();
            if ($stmtinsert >= 1) {


            echo '<script>window.location.href = "cart.php";</script>';
            } else {

                echo "Cannot insert";
            }


            $stmtinsert->close();
        }
    }


    $conn->close();
    return $result;
}
?>