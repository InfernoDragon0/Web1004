<?php
    session_start();
    $cartidToDelete = $_POST["cartid"];
    $caridToDelete = $_POST["carid"];

       deleteitem();


function deleteitem() {
    global $cartidToDelete, $caridToDelete, $memberid;
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
        $stmt= $conn->prepare("DELETE FROM .cart WHERE id = ? ");
        $stmt->bind_param("i", $cartidToDelete);
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

