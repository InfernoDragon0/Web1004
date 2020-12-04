<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "./includes/bootstrap-header.php" ?>
        <link rel="stylesheet" href="./css/cars.css">
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

                <div class="header-blue" style="margin-top:65px; min-height:800px; background: url(images/hd/<?php echo $row['media']?>);">
                    <div class="container hero">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-5 offset-xl-1" style="background: rgba(0,0,0,0.25);">
                                <h1><?php echo $row["model"]; ?></h1>
                                <p><?php echo $row['description']; ?></p>
                                <form action="additem.php" method="post">
                                <p><?php
                                    if ($row['stock'] > 0) {?>
                                 There are stock: <?php echo $row['stock']; ?>
                                  <?php  } else { ?>
                                    There is no stock
                                  <?php  }
                                    ?>
                                    </p>
                                    <p>Price is <?php echo "$" . $row['price']; ?></p>

                                    <select id="qty" name="qty">
                                    <?php
                                    for ($x = 1; $x <= $row['stock']; $x++) {
                                        echo '<option value="' . $x . '"><p>' . $x . '</p></option>';
                                    }
                                    ?>
                                    </select>
                                    <input type="text" name="carid" value="<?php echo $row["id"]; ?>" hidden>
                                    <button class="btn btn-light btn-lg action-button" type="submit">Add to Cart</button>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                </form>

                                <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder">
                                <div class="phone-mockup">
                                    <div class="screen"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        } else {
            echo "<h1>There is no car</h1>";
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
