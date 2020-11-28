<?php
session_start();
if (!isset($_SESSION['memberid']) || !$_SESSION['isAdmin']) {
    header('HTTP/1.0 403 Forbidden');
    echo "<meta http-equiv='refresh' content='0;url=./login.php'>";
    return;
}

else { //could have done ajax but nahh too ancient
    require_once "conntodb.php";
    $modType = $_GET['mod'];
    $id = $_GET['id'];

    switch ($modType) {
        case 'del':
            //do deletion function
            $stmt = $link->prepare("DELETE FROM orders WHERE id = ?"); //delete from orders
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $stmt2 = $link->prepare("DELETE FROM order_detail WHERE order_id = ?"); //from orderdetails
            $stmt2->bind_param("i", $id);
            $stmt2->execute();

            echo "<meta http-equiv='refresh' content='0;url=./admin.php'>";
        break;
        case 'upd':
            //do update status
            $status = $_GET['status'];
            $stmt2 = $link->prepare("UPDATE orders SET saleStatus = ? WHERE id = ?"); //from orderdetails
            $stmt2->bind_param("ii", $status, $id);
            $stmt2->execute();
            echo "<meta http-equiv='refresh' content='0;url=./admin.php'>";
        break;
    }
}

?>