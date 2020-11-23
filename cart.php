<html>
    <head>
        <?php include "./includes/header.php" ?>
    </head>
    <body>
        <?php include "./includes/nav.php" ?>
        <br>
        <br>
        <br>

        <?php
        $car = $_POST['carid'];
        $qty = $_POST['qty'];


        helloDb();

        function helloDb() {
            global $car;

            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");
            if (isset($_SESSION['memberid'])) {
                $userid = $_SESSION['memberid'];
                $username = $_SESSION['membername'];
            }

            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                echo $errorMsg;
                $success = false;
            } else {
                $stmtinsert = $conn->prepare("INSERT INTO cart(member_id,car_id,qty) VALUES('?','?','?')");
                $stmtselect = $conn->prepare("SELECT * FROM cart ca, car c  where ca.member_id = ? AND c.id = ca.car_id");

                $stmtinsert->bind_param("i,i,i", $car, $qty, $userid);
                $stmtinsert->execute();
                $stmtselect->bind_param("i", $userid);
                $stmtselect->execute();

                $result = $stmtselect->get_result();
                $row = $result->fetch_assoc();

                if ($result->num_rows > 0) {
                    ?>
                    <section id="showcart">
                        <h1><?php echo $username ?>'s Shopping Cart</h1>
                        <?php
                        if (isset($_GET['error'])) {
                            echo "<h1>Your Cart is empty</h1>";
                        } else {
                            ?>
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Cost</th>
                                </tr>
                                <?php
                                $grandTotal = 0;
                                While ($row = $result->fetch_assoc()) {
                                    $cartid = $row['c.id'];
                                    $carid = $row['car_id'];
                                    $carmodel = $row['model'];
                                    $carbrand = $row['brand'];
                                    $carprice = $row['price'];
                                    $qty = $row['qty'];
                                    ?>
                                    <tr>
                                        <td><?php echo $carmodel; ?></td>
                                        <td><?php echo $carbrand; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td>
                                            <!-- update cart change qty -->
                                            <form action="updatecart.php" method="post">
                                                <br>
                                                <label>New Quantity:</label>
                                                <select id="qty" name="qty">
                                                    <?php
                                                    for ($x = 1; $x <= $row['stock']; $x++) {
                                                        echo '<option value="' . $x . '">' . $x . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <br>
                                                <input type="submit" value="Update">
                                                <input type="text" name="cartid" value="<?php echo $cartid; ?>"hidden>
                                                <input type="text" name="carid" value="<?php echo $carid; ?>"hidden>

                                            </form>
                                        </td>
                                        <td>
                                            <!-- delete item in cart -->
                                            <form action="deleteitem.php" method="post">
                                                <input type="submit" value="Delete">
                                                <input type="text" name="cartid" value="<?php echo $cartid; ?>"hidden>
                                                <input type="text" name="carid" value="<?php echo $carid; ?>"hidden>
                                            </form>
                                        </td>
                                        <td><?php echo number_format($carprice * $qty, 2); ?></td>
                                        <?php $grandTotal += $carprice * $qty; ?>


                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td>Grand Total : <?php echo number_format($grandTotal, 2) ?></td>
                                </tr>

                            </table>
                            <a href="checkout.php">Checkout</a>
                        <?php } 
                        
                        //and more!
                    } else {
                        echo "Your cart is empty";
                    }

                    $stmt->close();
                }
            }
            ?>
    </body>
</html>
