<html>
    <head>
        <?php include "./includes/header.php" ?>
    </head>
    <body>
        <?php include "./includes/nav.php" ?>
        <?php
//do some weird stuff for fetching all cars of the selected brand
        $car = $_GET['id'];
        echo "your car is " . $car;

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
                $stmt = $conn->prepare("SELECT * FROM project1004.car WHERE id=?");

                //int id, varchar catID, varchar brand, varchar heading, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo, int isMain

                $stmt->bind_param("s", $car);
                $stmt->execute();
                $result = $stmt->get_result();

                $vid = "none";
                echo $result->num_rows;
                if ($result->num_rows > 0) {
                    //$row = $result->fetch_assoc();
                    $d1 = 0;
                    while ($row = $result->fetch_assoc()) {
                        //data for images
                        $bigimage = $row["media"];
                        //$logo = $row["brand"] . ".png"; //
                        //$isMain = $row["isMain"]; //use this to show as the hero image
                        //data for the car desc
                        $model = $row["model"];
                        $description = $row["description"];
                        $brandx = $row["brand"];
                        //$heading = $row["heading"];
                        $carid = $row["id"];
                        if ($isMain == 1) {
                            ?>
                            <img src="images/hd/<?php echo $bigimage ?>"/>
                            <div class="brandhero">
                                <p class="hero-title"><?php echo strtoupper($brandx) ?></p>
                            </div>
                        </div>
                        <div class="logoheader">
                            <p class="brand-description"><?php echo $description ?></p>
                            <p class="short-desc">Cars of <?php echo $brandx ?></p>
                            <hr class="short">
                        </div>
                    <?php
                }

                if ($d1 == 0) {
                    ?>
                        <div class="car-container">
                        <?php
                        $d1 = 1;
                    }
                }

                if ($d1 == 1) {
                    ?>
                    </div>
                        <?php
                        $d1 = 2;
                    }
                } else {
                    echo "<br><br><br><p class='hero-title'>No cars in this brand</p>";
                }
                $stmt->close();
            }
        }
        ?>
</body>
</html>
