<html>
    <head>
    <meta charset="UTF-8">
        <?php
            include "./includes/header.php"
        ?>
        <title>Cats</title>
</head>
<body>
    <?php
        include "./includes/nav.php"
    ?>

    <div class="auth">
        <img src="./images/hd/cat1.png"/>
        <div class="auth-container">
            <div id="login">
                <br>
                <br>
                <p class="auth-header">WEBSITE NAME</p>
                <input type="text" class="inputs" placeholder="Username"/>
                <input type="password" class="inputs" placeholder="Password"/><br>
                <input type="checkbox" id="cb"/><label for="cb">Remember me</label><br>
                <br><br>
                <button class="auth-submit">Login</button><br>
                <a class="qs" href="./forget.php">Forget Password</a>
                <hr>
                <p class="qs">New? Click <a href="#">Here to register</a></p>

            </div>
        </div>

    </div>

</body>

</html>