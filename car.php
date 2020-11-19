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
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['project1004']);

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

               
               if ($success)
                {
                    echo $car;
                }
                else 
                {
                }
                $stmt->close();
            }
        }
        ?>
    </body>
</html>
