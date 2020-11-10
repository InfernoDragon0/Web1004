<?php

//do some weird stuff for fetching all cars of the selected brand
$car = $_GET['car']; 
helloDb();

function helloDb() {
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } 
    else {
        $stmt = $conn->prepare("SELECT * FROM car_list WHERE model=?");

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
        }
        $stmt->close();
    }
}

?>