<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>php1004v2</title>
    
    <link rel="stylesheet" href="./css/Bootstrap-DataTables.css">
    <link rel="stylesheet" href="./css/Header-Dark.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
    <?php include './includes/bootstrap-header.php'; ?>
</head>

<body>
<?php include './includes/nav.php'; ?>
    <div>
        <div class="header-dark" style="background: url(&quot;https://i.imgur.com/Q4etkjd.png&quot;);min-height: 0;">
        <br>
        <br>
        <br>
            <div class="container hero">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="author"><img class="rounded-circle" src="./images/logos/cat.gif">
                            <h5 class="text-white name"><?php echo $_SESSION['name'] . " " . $_SESSION['last_name']?></h5>
                            <p class="text-white title"><?php echo ($_SESSION['isAdmin'] ? "Admin" : "User")?></p>
                        </div>
                        <hr>
                        <form action="accountEdit.php" method="get">
                          <button class="btn btn-primary" type="submit">Edit Profile</button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div><div class="bootstrap_datatables">
<div class="container py-5">
  <header class="text-center text-black">
    <h1 class="display-4">My Orders</h1>
  </header>
  <div class="row py-5">
    <div class="col-lg-10 mx-auto">
      <div class="card rounded shadow border-0">
        <div class="card-body p-5 bg-white rounded">
          <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Transaction Date</th>
                  <th>Charge ID</th>
                  <th>Sale Status</th>
                  <th>Car Count</th>
                </tr>
              </thead>
              <tbody>

              <?php
                    //order history READ
                    session_start();
                    $memberid = 1; //debug only
                    if (isset($_SESSION['memberid'])) {
                        $memberid = $_SESSION['memberid']; //for later use
                    }
                    else {
                        echo "<meta http-equiv='refresh' content='0;url=./login.php'>";
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

                        //$stmt = $conn->prepare("SELECT * FROM orders os, order_details ods where member_id = ? and os.id = ods.order_id");
                        //select id, chargeid, transaction date and count the number of cars in the order, groupby to allow count()
                        $stmt = $conn->prepare("SELECT os.id, charge_id, transaction_date, saleStatus, count(car_id) cars FROM orders os, order_detail od where member_id = ? and os.id = od.order_id group by os.id");
                        $stmt->bind_param("i", $memberid);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()) {
                            //$carid = $row["car_id"];
                            //$qty = $row["qty"];

                            //only need to show the order ids
                            $orderid = $row["id"];
                            $tdate = $row["transaction_date"];
                            $chargeid = $row["charge_id"];
                            $salestatus = $row["saleStatus"];
                            $totalCars = $row["cars"]; //count(car_id) cars

                            //write html here
                            ?>
                                <tr>
                                  <td><?php echo $orderid?></td>
                                  <td><?php echo $tdate?></td>
                                  <td><?php echo $chargeid?></td>
                                  <td><?php echo $salestatus?></td>
                                  <td><?php echo $totalCars?></td>
                                </tr>
                                

                            <?php

                        }
                    }
                    
                    //order history DELETE
                ?>



              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="./js/Bootstrap-DataTables.js"></script>
    <?php
            include "./includes/footer.php";
        ?>
</body>

</html>