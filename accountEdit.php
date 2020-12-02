<html lang="en">
    <head>
    <meta charset="UTF-8">
        <?php
            include "./includes/header.php"
        ?>
</head>
<body>
    <?php
        include "./includes/nav.php"
    ?>
    
    <p> </p>
    <p> </p>
    <p> </p>
<!--  extra 3x <p> </p>  to insert extra spaces, ensure navbar doesnt block contents-->
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
<div class="auth">
        <img src="./images/hd/cat1.png"/>
        <div id="login" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">Login to view/edit profile</p>
                <form action="LoginProcess1.php<?php echo $redirector;?>" method="post">
                <input aria-label="email" type="email" class="inputs" name="email" required placeholder="Email"/>
                <input aria-label="password" type="password" class="inputs" name="password" required placeholder="Password"/><br>
                <br><br>
                <button class="auth-submit">Login</button><br>
                </form>
        </div>
        
  </div>

        <?php
            include "./includes/footer.php";
        ?>
</body>

</html>