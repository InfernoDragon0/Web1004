<html>
<head>
    <?php include "./includes/header.php"?>
</head>
<body>
    <?php include "./includes/nav.php" ?>

<?php

//do some weird stuff for fetching all cars of the selected brand
$brand = $_GET['brand']; 
echo "your brand is ". $brand;

helloDb();


function helloDb() {
    global $brand;

    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        echo $errorMsg;
        $success = false;
    } 
    else {
        $stmt = $conn->prepare("SELECT * FROM car_list WHERE brand=?");

        //int id, varchar catID, varchar brand, varchar heading, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo, int isMain

        $stmt->bind_param("s", $brand);
        $stmt->execute();
        $result = $stmt->get_result();

        $vid = "none";
        echo $result->num_rows;
        if ($result->num_rows > 0) {
            //$row = $result->fetch_assoc();
            $d1 = 0;
            while($row = $result->fetch_assoc()) {
                //data for images
                $bigimage = $row["bigImage"];
                $logo = $row["logo"];
                $isMain = $row["isMain"]; //use this to show as the hero image
                
                //data for the car desc
                $model = $row["model"];
                $description = $row["description"];
                $brandx = $row["brand"];
                $heading = $row["heading"];

                if ($isMain == 1) {
                    ?>
                        <div class="brand-main">
                            <img src="images/hd/<?php echo $bigimage?>"/>
                            <div class="brandhero">
                                <p class="hero-title"><?php echo strtoupper($brandx)?></p>
                            </div>
                        </div>
                        <div class="logoheader">
                            <p class="brand-description"><?php echo $description?></p>
                            <img src="images/logos/<?php echo $logo?>"/>
                            <p class="short-desc">Cars of <?php echo $brandx?></p>
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

                if ($isMain == 0 && $description != "VIDEO")  {
                    ?>
                        <div class="brand-car">
                            <img src="images/hd/<?php echo $bigimage?>"/>
                            <div class="car-data">
                                <p class="car-title"><?php echo $model?></p>
                                <p class="car-description"><?php echo $heading?></p>
                            </div>
                        </div>
                    <?php
                }

                if ($description == "VIDEO") {
                    $vid = $bigimage;
                }
            }

            if ($d1 == 1) {
                ?>
                    </div>
                <?php

                $d1 = 2;
            } 
            
            if ($vid != "none") {
                ?>

                <div class="brand-video">
                    <p class="video-heading"><?php echo strtoupper($brandx)?> SHOWCASE</p>
                    <iframe src="<?php echo $vid?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                
                <?php
            }

            
            

        } else {
            echo "<br><br><br><p class='hero-title'>No cars in this brand</p>";
        }
        $stmt->close();
    }
}

?>

<script>

    const slider = document.querySelector('.car-container');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        //slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
        isDown = false;
        //slider.classList.remove('active');
    });
    slider.addEventListener('mouseup', () => {
        isDown = false;
        //slider.classList.remove('active');
    });
    slider.addEventListener('mousemove', (e) => {
        if(!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        slider.scrollLeft = scrollLeft - walk;
    });

</script>

</body>
</html>