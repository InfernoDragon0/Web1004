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

    <div class="auth">
        <img src="./images/hd/cat1.png"/>
        <div id="login" class="auth-container active">
                <br>
                <br>
                <p class="auth-header">WEBSITE NAME</p>
                <input type="email" class="inputs" placeholder="Email"/>
                <input type="password" class="inputs" placeholder="Password"/><br>
                <input type="checkbox" id="cb"/><label for="cb">Remember me</label><br>
                <br><br>
                <button class="auth-submit">Login</button><br>
                <a class="qs" href="./forget.php">Forget Password</a>
                <hr>
                <p class="qs">New? Click <a onclick="switchTab(event, 'register');">Here to register</a></p>
        </div>

        <div id="register" class="auth-container">
                <br>
                <br>
                <p class="auth-header">REGISTER NOW</p>
                <form action="RegisterProcess.php" method="post">
                    <input type="text" class="form-control" required placeholder="First Name" id="fname"/>
                    <input type="text" class="form-control" required placeholder="Last Name" id="lname"/>
                    <input type="email" class="form-control" required placeholder="Email Address" id="email"/>
                    <input type="password" class="form-control" required placeholder="Password" id="pw"/>
                    <input type="password" class="form-control" required placeholder="Re-Password" id="pw_confirm"/><br>
                    <input type="checkbox" id="tc" required /><label for="tc">I have read and agreed to the terms and conditions</label><br>
                    <input type="checkbox" id="mailing" required /><label for="mailing">I want spam mail</label><br>
                    <br><br>
                    <button class="auth-submit">Register</button><br>
                    <hr>
                </form>
                <p class="qs">Have an account? Click <a onclick="switchTab(event, 'login');">Here to login</a></p>
        </div>

    </div>


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
