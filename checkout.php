<html>
    <head>
    <meta charset="UTF-8">
        <?php
            include "./includes/header.php"
        ?>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="./css/stripe.css">
</head>
<body>
    <?php
        include "./includes/nav.php"
    ?>

    <div class="auth">
        <img id="showcase" src="./images/hd/floorneedspolish.png"/>
        <div class="checkout-container">
            <br>
            <br>


            <div class="page-header">
                <div class="data">
                    <h1 id="orderheading">Your Order</h1>
                    <h2 id="orderpricing">$0 SGD</h2>
                </div>

                <!-- hide the button if thcart is empty-->
            </div>

            <div class="cart">

            <?php
                require_once('vendor/autoload.php'); //composer autoload, for stripe
                session_start();
                $memberid = 1;
                $intent = ""; //for stripe

                setlocale(LC_MONETARY, 'en_US.UTF-8'); //for money_format to currency USD $

                if (isset($_SESSION['memberid'])) {
                    $memberid = $_SESSION['memberid'];
                }
                else {
                    header("Location: ./login.php?rd=checkout"); //header wont work because bootstrap is bad bad
                    echo "<meta http-equiv='refresh' content='0;url=./login.php?rd=checkout'>";

                    return;
                }
                
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    echo $errorMsg;
                    $success = false;
                } 
                else {
                    $stmt = $conn->prepare("SELECT * FROM cart ca, car c  where ca.member_id = ? AND c.id = ca.car_id");

                    //int id, varchar catID, varchar brand, varchar heading, float price, int stock, bool forRent, varchar model,text description,varchar bigImage,varchar logo, int isMain

                    $stmt->bind_param("i", $memberid);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $totalprice = 0;
                    //echo $result->num_rows;
                    if ($result->num_rows > 0) {
                        //$row = $result->fetch_assoc();

                        $d1 = 0;
                        
                        while($row = $result->fetch_assoc()) {
                            

                            $display = $row["media"];
                            $logo = $row["brand"] . ".png";
                            $itemname = strtoupper($row["brand"]) . " " . $row["model"];
                            $price = money_format('%.2n', $row["price"]);
                            $totalprice += $row["price"]; 
                            if ($d1 == 0) {
                                echo "<script>document.getElementById('showcase').src = './images/hd/$display';</script>";
                                $d1 = 1;
                            }

                            ?>
                                <div class="cart-data">
                                    <img class="display" src="./images/hd/<?php echo $display?>"/>
                                    <img class="small-logo" src="./images/logos/<?php echo $logo?>"/>
                                    <p class="item-name"><?php echo $itemname?></p>
                                    <div class="item-data">
                                        <p><?php echo $price?></p>
                                    </div>
                                </div>
                            <?php
                        }

                        
                        //stripe initialize, this secretkey is a test
                        \Stripe\Stripe::setApiKey('sk_test_51Hs3bsBSbRVapwZw2VcuX5ux9edv11xbDQRA2DRM8vnT5428GWDqOINBf6vjbc4PqS6pmTxwr90TtTSKMOOuwCHq00wh0BiG3k');

                        $intent = \Stripe\PaymentIntent::create([
                        'amount' => $totalprice*100, //payment in cents
                        'currency' => 'sgd',
                        ]);

                        echo "<script>document.getElementById('orderpricing').innerHTML = '". money_format('%.2n', $totalprice) ."';</script>";

                    }
                    else {
                        //also hide checkout button
                        echo "<script>document.getElementById('orderheading').innerHTML = 'No items. Add more!';</script>";
                    }

                    if ($result->num_rows < 5) {
                        $extra = 5-$result->num_rows;

                        for ($i = 0; $i < $extra; $i++) {
                            ?>
                                <div class="cart-data">
                                    <a href="./">
                                        <img class="display" src="./images/hd/background.jpg"/>
                                        <img class="smaller-logo" src="./images/logos/plus.png"/>
                                        <p class="item-name light-accent">Continue Shopping!</p>
                                        <div class="item-data">
                                            <p></p>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                    }
                }

                //;
            ?>
            
            </div>

                        
            <form action="./purchaseHandler.php" method="post" id="payment-form">
            <div class="form-row">
                <div class="page-header">
                    <div class="data">
                        <h1 id="orderheading">Payment: Credit Card</h1>
                    </div>
                </div>
                <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>

            <button id="cobutton" class="cobutton" data-secret="<?php echo $intent->client_secret ?>">Checkout</button>
            </form>
                
        </div>

    </div>


    <!-- <div class="checkout-container">
        

        

        <div class="checkout">
            <p>Confirm your order</p>
            <p>Total: $9,999,999 SGD</p>
            <p>Select a payment method</p>
            <div class="card-form"></div> place credit card info here
            <button>Complete Payment</button>  button will check out after confirming login password 
            <p>WE ACCEPT</p>
            <p>icons of visa mc etc</p>
        </div>

        <div class="checkout-completed"> hidden until completed
            <p>tick/cross icon</p>
            <p>Payment Successful / Failed</p>
            <p>Total: $9,999,999 SGD</p>
            <p>You will receive an invoice via your email.</p>
            <button>View Order Status</button> button will check out after confirming login password 
        </div>
    </div> -->
    <?php
            include "./includes/footer.php";
        ?>
</body>

<script>
    //for payments
    var stripe = Stripe('pk_test_51Hs3bsBSbRVapwZwJaGdkddKhwOH1jPoAnBLj5w4vCFvMHebOWkLQg4I9d1QGCxrkW0lFTYKhmYLgjV84X8jYCOe00POi5NMh4');
    var elements = stripe.elements();

    var style = { //custom styling
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) { //dont even need token
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    // var hiddenInput = document.createElement('input');
    // hiddenInput.setAttribute('type', 'hidden');
    // hiddenInput.setAttribute('name', 'stripeToken');
    // hiddenInput.setAttribute('value', token.id);
    // form.appendChild(hiddenInput);

    stripe.confirmCardPayment(document.getElementById('cobutton').dataset.secret, {
        payment_method: {
        card: card
        }
        }).then(function(result) {
            if (result.error) {
                // Show error
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'results');
                hiddenInput.setAttribute('value', result.error.message);
                form.appendChild(hiddenInput);
                form.submit();
                console.log(result.error.message);
            } 
            else {
                // The payment successs
                if (result.paymentIntent.status === 'succeeded') {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'results');
                    hiddenInput.setAttribute('value', 'success');
                    form.appendChild(hiddenInput);

                    var hiddenInput2 = document.createElement('input');
                    hiddenInput2.setAttribute('type', 'hidden');
                    hiddenInput2.setAttribute('name', 'chargeid');
                    hiddenInput2.setAttribute('value', result.paymentIntent.id);
                    form.appendChild(hiddenInput2);
                    form.submit();
                }
            }
        })
    }

    var cartdatas = document.getElementsByClassName("cart-data")
    var showcase = document.getElementById("showcase")
    
    Array.from(cartdatas).forEach((element) => {
        element.addEventListener('click', () => {
            showcase.src = element.firstElementChild.src
        })
    })

</script>

</html>