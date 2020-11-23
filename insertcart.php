
        <?php
        $car = $_POST['carid'];
        $qty = $_POST['qty'];


        helloDb();

        function helloDb() {
            global $car;

            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");
            if (isset($_SESSION['memberid'])) {
                $userid = $_SESSION['memberid'];
                $username = $_SESSION['membername'];
            }

            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                echo $errorMsg;
                $success = false;
            } else {
                $stmtinsert = $conn->prepare("INSERT INTO cart(member_id,car_id,qty) VALUES('?','?','?')");

                $stmtinsert->bind_param("i,i,i", $car, $qty, $userid);
                $stmtinsert->execute();
                header("Location:cart.php");
                $stmt->close();
                }
            }
            ?>
