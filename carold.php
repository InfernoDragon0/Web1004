<!DOCTYPE html>
<html lang="en">
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

                    <div class="caritem">
                        <div class="caritem-data">

                            <img class="display" src="images/hd/<?php echo $row['media']; ?>">
                            <aside id="detail">
                                <p class="name"><?php echo $row["model"]; ?></p><br>
                                <p class="price" ><?php echo "$" . $row['price']; ?></p><br>
                                <p class="description"><?php echo row['description']; ?> </p><br>
                                <p class="stock"><?php
                                    if ($row[stock] > 0) {?>
                                <p> There are stock: <?php echo $row['stock']; ?></p>
                                  <?php  } else { ?>
                                    <p>There is no stock <p>
                                  <?php  }
                                    ?>
                                </p>
                                <label for="cars"><p>Quantity:</p></label>
                                <form action="additem.php" method="post">
                                    <select id="qty" name="qty">
                                    <?php
                                    for ($x = 1; $x <= $row['stock']; $x++) {
                                        echo '<option value="' . $x . '"><p>' . $x . '</p></option>';
                                    }
                                    ?>
                                    </select>
                                    <br>
                                    <input type="submit" value="Add to cart" class="buttoncart">
                                    <input type="text" name="carid" value="<?php echo $row["id"]; ?>" hidden>
                                </form>
                            </aside>
                        </div>
                    </div>
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
