<html>
<head>
    <?php include "./includes/header.php"?>
</head>
<body>
    <?php include "./includes/nav.php" ?>

<?php

//do some weird stuff for fetching all cars of the selected brand
$brand = $_GET['brand']; 
helloDb();

echo "your brand is ". $brand;

function helloDb() {
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } 
    else {
        $stmt = $conn->prepare("SELECT * FROM car_list WHERE brand=?");

        //int id, varchar catID, varchar brand, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo, int isMain

        $stmt->bind_param("s", $brand);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            //data for images
            $bigimage = $row["bigimage"];
            $logo = $row["logo"];
            $isMain = $row["isMain"]; //use this to show as the hero image
            
            //data for the car desc
            $model = $row["model"];
            $description = $row["description"];

        } else {
            $errorMsg = "No cars in this brand";
            $success = false;
        }
        $stmt->close();
    }
}

?>

    <div class="brand-main">
        <img src="<?php echo "images/hd/cat4.png"?>"/>
        <div class="hero-data">
            <p class="hero-title">B U G C A T T I</p>
            <p class="hero-description">This is a car</p>
        </div>
    </div>
    <div class="logoheader"></div>

</body>
</html>