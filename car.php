<html>
    <head>
        <?php include "./includes/header.php" ?>
    </head>
    <body>
        <?php include "./includes/nav.php" ?>
        <?php
        $car = $_GET['id'];
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
                $stmt = $conn->prepare("SELECT * FROM car WHERE id=?");
                $stmt->bind_param("i", $car);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc(); 

                if ($result->num_rows > 0) {
                    ?>
                    <section id="product">
                        <span class="name"><?php echo $row["model"]; ?></span><br>
                        <img src="images/hd/<?php echo $row['media']; ?>">
                        <aside id="detail">
                            <span class="price" ><?php echo "$" . $row['price']; ?></span><br>
                            <span class="stock"><?php 
                            if($row[stock] > 0)
                            {
                                echo "There are stock: " . $row['stock'];
                            }
                            else{
                                echo "There is no stock";
                            }
                            ?>
                            </span>
                            <label for="cars">Quantity:</label>
                            <form action="additem.php" method="post">
                                <select id="qty" name="qty">
                                    <?php
                                    for ($x = 1; $x <= $row['stock']; $x++) {
                                        echo '<option value="' . $x . '">' . $x . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Add to cart" class="buttoncart">
                                <input type="text" name="carid" value="<?php echo $row["id"]; ?>" hidden>
                            </form>
                        </aside>

                    </section>
                    <?php
                } else {
                    echo "No results!";
                }

                $stmt->close();
            }
        }
        ?>
        <?php
            include "./includes/footer.php";
        ?>
    </body>
</html>
