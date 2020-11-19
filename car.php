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
//do some weird stuff for fetching all cars of the selected brand
        $car = $_GET['id'];
        echo "<br><br><br><p>your car is $car</p>";

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
                //int id, varchar catID, varchar brand, varchar heading, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo, int isMain
                
                $result = $stmt->get_result();
                $row = $result->fetch_assoc(); //not a while loop cos should only take one car 

                if ($result->num_rows > 0) {
                    echo "<p>" . $row["id"] . "<p>";
                    echo "<p>" .$row["brand"] . "<p>";
                    echo "<p>" .$row["model"] . "<p>";
                    echo "<p>" .$row["price"] . "<p>";
                    echo "<p>" .$row["stock"] . "<p>";

                    //and more!
                }
                else {
                    echo "No results!";
                }

                $stmt->close();
            }
        }
        ?>
    </body>
</html>
