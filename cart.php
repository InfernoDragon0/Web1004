<!DOCTYPE html>
<html lang="en">
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

        <div class="auth">
            <img id="showcase" src="./images/hd/floorneedspolish.png"/>
            <div class="checkout-container">
                <br>
                <br>


                <div class="page-header">
                    <div class="data">
                        <h1 id="cartheading">Your Order</h1>
                        <h2 id="pricing">$0 SGD</h2>
                    </div>
                    <button id="cobutton" onclick="window.location.href = './checkout.php'" class="cobutton">Checkout</button>
                    <!-- hide the button if thcart is empty-->
                </div>

                <div class="cart">

                    <?php
                    session_start();

                    if (isset($_SESSION['memberid'])) {
                    $memberid = $_SESSION['memberid'];
                }
                else {
                    header("Location: ./login.php?rd=cart"); //header wont work because bootstrap is bad bad
                    echo "<meta http-equiv='refresh' content='0;url=./login.php?rd=cart'>";

                    return;
                }

                    $config = parse_ini_file('../../private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

                    if ($conn->connect_error) {
                        $errorMsg = "Connection failed: " . $conn->connect_error;
                        echo $errorMsg;
                        $success = false;
                    } else {
                        $stmt = $conn->prepare("SELECT *, cart.id as cartid from cart inner join car ON cart.car_id = car.id where member_id = ?");
                        
                        //int id, varchar catID, varchar brand, varchar heading, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo, int isMain
                        $stmt->bind_param("i", $memberid );
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $totalprice = 0; //should we add SGD?
                        //echo $result->num_rows;
                        if ($result->num_rows > 0) {
                            //$row = $result->fetch_assoc();

                            $d1 = 0;

                            while ($row = $result->fetch_assoc()) {

                                $carid = $row['car_id'];
                                $cartid = $row['cartid'];
                                $display = $row["media"];
                                $qty = $row['qty'];
                                $logo = $row["brand"] . ".png";
                                $itemname = strtoupper($row["brand"]) . " " . $row["model"];
                                $price = money_format('%.2n', $row["price"]);
                                $totalprice += $row["price"];
                                $stock = $row['stock'];
                                if ($d1 == 0) {
                                    echo "<script>document.getElementById('showcase').src = './images/hd/$display';</script>";

                                    $d1 = 1;
                                }
                                ?>
                                <div class="cart-data">
                                    <img class="display" src="./images/hd/<?php echo $display ?>"/>
                                    <img class="small-logo" src="./images/logos/<?php echo $logo ?>"/>
                                    <p class="item-name"><?php echo $itemname ?></p>
                                    <input type="text" name="cartid" value="<?php echo $cartid; ?>" hidden>
                                    <div class="item-data">
                                        <p>$<?php echo $price ?></p>
                                        <p>Quantity: <?php echo $qty ?></p>
                                    <div class="update-delete">
                                        <div class="deleteitem">
                                            <form action="deleteitem.php" method="post">
                                                <input class="deletebutton" type="submit" value="X">
                                                <input  class="item-name" type="text" name="cartid" value="<?php echo $cartid; ?>" hidden>
                                            </form>
                                        </div>
                                        <div class="updatecart">
                                            <form action="updatecart.php" method="post">
                                                <label>New Quantity:</label>
                                                <select id="qty" name="qty">
                                                    <?php
                                                    for ($x = 1; $x <= $stock; $x++) {
                                                        echo '<option value="' . $x . '">' . $x . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <br>
                                                <input type="submit" value="Update">
                                                <input type="text" name="cartid" value="<?php echo $cartid; ?>">
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                    
                                </div>

                                <?php
                            }



                            echo "<script>document.getElementById('pricing').innerHTML = '" . money_format('%.2n', $totalprice) . "';</script>";
                        } else {
                            //also hide checkout button
                            echo "<script>document.getElementById('cartheading').innerHTML = 'No items. Add more!';</script>";
                        }

                        if ($result->num_rows < 5) {
                            $extra = 5 - $result->num_rows;

                            for ($i = 0; $i < $extra; $i++) {
                                ?>
                                <div class="cart-data">
                                    <a href="./">
                                        <img class="display" src="./images/hd/background.jpg"/>
                                        <img class="smaller-logo" src="./images/logos/plus.png"/>
                                        <p class="item-name light-accent">Continue Shopping!</p>
                                        <div class="item-data">
                                            <p></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

                </div>

            </div>

        </div>
        <?php
            include "./includes/footer.php";
        ?>
    </body>

    <script>
        var cartdatas = document.getElementsByClassName("cart-data")
        var showcase = document.getElementById("showcase")

        Array.from(cartdatas).forEach((element) => {
            element.addEventListener('click', () => {
                showcase.src = element.firstElementChild.src
            })
        })



    </script>

</html>