<html>
    <head>
        <?php include "./includes/header.php" ?>
    </head>
    <body>
        <?php include "./includes/nav.php" ?>


        <?php
        // get car id to view
        $car = $_GET['id'];
        echo "your carid is " . $car;
        helloDb();

        function helloDb() {
//            $config = parse_ini_file('../../private/db-config.ini');
//            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
//
//            if ($conn->connect_error) {
//                $errorMsg = "Connection failed: " . $conn->connect_error;
//                $success = false;
//            } else {
//                $stmt = $conn->prepare("SELECT * FROM car WHERE id=?");
            global $car;

            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                echo $errorMsg;
                $success = false;
            } else {
                $stmt = $conn->prepare("SELECT * FROM car WHERE id=?");

                //int id, varchar catID, varchar brand, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo

                $stmt->bind_param("s", $car);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) { //there should only be one
                    $row = $result->fetch_assoc();
                    //data for images
                    $bigimage = $row["bigimage"];
                    $logo = $row["logo"];

                    //data for the car desc
                    $model = $row["model"];
                    $description = $row["description"];
                } else {
                    $errorMsg = "No named cars found";
                    $success = false;
                } if ($isMain == 1) {
                    ?>
                    <div class="itemcar">
                            <img src="images/hd/<?php echo $bigimage ?>"/>
                        <div class="brandhero">
                            <p class="hero-title"><?php echo strtoupper($brandx) ?></p>
                        </div>
                    </div>
                    <div class="logoheader">
                        <img src="images/logos/<?php echo $logo ?>"/>
                        <p class="short-desc">Cars of <?php echo $brandx ?></p>
                        <hr class="short">
                    </div>
                    <?php
                }
                $stmt->close();
            }
        }
        ?>
    </body>
</html>
