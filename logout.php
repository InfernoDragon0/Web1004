<?php

session_start();
if(isset($_SESSION['email']))
{
    session_destroy();
    echo"<a href='login.php' class='btn btn-warning' type>Return to Login</a>";
}
else
{
    echo"<a href='login.php' class='btn btn-warning' type>Return to Login</a>";
}
?>
