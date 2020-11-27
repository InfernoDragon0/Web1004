<?php
        session_start();
        $car = $_POST['carid'];
        $qty = $_POST['qty'];
        $userid = 19;
        if (isset($_SESSION['memberid'])) {
            $userid = $_SESSION['memberid'];
        }       
        else{
            header("Location:login.php");
            
        }
       additem();


function additem() {
    global $userid, $car, $qty;
    // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'project1004');
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $result = 0;
    }
    else
    {
        $stmtinsert = $conn->prepare("INSERT INTO cart(member_id,car_id,qty) VALUES(?,?,?)");
        $stmtinsert->bind_param("iii", $userid, $car, $qty);
        $stmtinsert->execute();
   if($stmtinsert >= 1)    
	{
		

		header("Location:checkout.php");
	}
	else     
	{
		
		echo $stmtinsert;	
	}
    

        $stmt->close();
    }
    $conn->close();
    return $result;
}

?>