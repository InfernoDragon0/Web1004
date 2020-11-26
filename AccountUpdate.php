<html>
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
   
                 
<div id="update" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">Update Account</p>
                <form action="UpdateProcess.php" method="post">
                    <input type="text" class="inputs" required placeholder="First Name" value= '$first_name' name="first_name"/>
                    <input type="text" class="inputs" required placeholder="Last Name" value="default value" name="last_name"/>
                    <input type="email" class="inputs" required placeholder="Email Address" value="default value" name="email"/>
                    <input type="password" class="inputs" required placeholder="Password" value="default value" name="password"/>
                    <input type="password" class="inputs" required placeholder="Re-Password" value="default value" name="password_confirm"/><br>
                    <br><br>
                    <button class="auth-submit">Update</button><br>
                    <hr>
                </form>
        </div>

</body>

</html>
