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

    <?php
        //check if logged in already, then bypass login page if already logged in
        session_start();
        $redirector = "";
        if (isset($_SESSION['memberid'])) {
            header("Location:./index.php", true, 303); //headers dont work cos bootstrap bad bad
            echo "<meta http-equiv='refresh' content='0;url=./index.php'>";
            return;
        }

        if (isset($_GET['rd'])) {
            $redirector = "?rd=".$_GET['rd'];
        }
    ?>

    <div class="auth">
        <img src="./images/hd/cat1.png" aria-label="background image"/>
        <div id="login" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">LUXAUTO</p>
                <form action="LoginProcess.php<?php echo $redirector;?>" method="post">
                <input aria-label="email" type="email" class="inputs" name="email" required placeholder="Email"/>
                <input aria-label="password" type="password" class="inputs" name="password" required placeholder="Password"/><br>
                <input aria-label="remember me button"type="checkbox" id="cb"/><label for="cb">Remember me</label><br>
                <button class="auth-submit">Login</button><br>
                </form>
                <a class="qs" href="./forget.php">Forget Password</a>
                <hr>
                <p class="qs">New? Click <a onclick="switchTab(event, 'register');">Here to register</a></p>
        </div>

        <div id="register" class="auth-container">
                <br>
                <p class="auth-header">REGISTER NOW</p>
                <form action="RegisterProcess.php" method="post">
                    <input aria-label="first name" type="text" class="inputs" required placeholder="First Name" name="first_name"/>
                    <input aria-label="last name" type="text" class="inputs" required placeholder="Last Name" name="last_name"/>
                    <input aria-label="email" type="email" class="inputs" required placeholder="Email Address" name="email"/>
                    <input aria-label="password" type="password" class="inputs" required placeholder="Password" name="password" minlength="8" maxlength="20"/>
                    <input aria-label="re-enter password" type="password" class="inputs" required placeholder="Re-enter Password" name="password_confirm" minlength="8" maxlength="20"/>
                    <input aria-label="agree to terms and condition" type="checkbox" id="tc" name="tc" required /><label for="tc">I have read and agreed to the terms and conditions</label><br>
                    <input aria-label="subscribe to mailing" type="checkbox" id="mailing" name="mailing" /><label for="mailing">I want spam mail</label>
                    <button class="auth-submit">Register</button><br>
                    <hr>
                </form>
        </div>

    </div>

  
 <?php
            include "./includes/footer.php";
        ?>
</body>
 
<script>
    function switchTab(evt, tabName) {
        var i, tabcontent;
        tabcontent = document.getElementsByClassName("auth-container");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
    }
</script>

</html>
