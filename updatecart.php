<?php
session_start();
$cartid = $_POST["cartid"];
$qty = $_POST["qty"];
//        if (isset($_SESSION['id'])) {
//            echo $userid = $_SESSION['id'];
//        }       
//        else{
//            header("Location:login.php");
//            
//        }
       updateitem();


function updateitem() {
    global  $qty, $cartid;
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
        $stmt = $conn->prepare("UPDATE cart SET  qty = ? WHERE id= ? ");
        $stmt->bind_param("ii", $qty,$cartid );
        $stmt->execute();
   if($stmt >= 1)    
	{
            echo '<script>window.location.href = "cart.php";</script>';
	}
	else     
	{
		
		echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";	
	}
    

        $stmt->close();
    }
    $conn->close();
    return $result;
}

?>

