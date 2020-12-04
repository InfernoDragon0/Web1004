<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <?php
        include "./includes/header.php";?>

    <style>
        .wrapper{
            min-width: 650px;
            margin: 0 auto;
            background: white;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .text-color {
            color: white;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <span class ="text-color">
    <?php
        include "./includes/nav.php";
        
        session_start();
        if (!isset($_SESSION['memberid']) || !$_SESSION['isAdmin']) {
            header('HTTP/1.0 403 Forbidden');
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<h1>Forbidden</h1>";
            echo "You must have admin privileges to access this page.";
            echo "<br>";
            echo "<br>";
        }
        else {
            ?>
    </span>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix">
                                <br>
                                <br>
                                <br>
                                <br>
                                <h2 class="pull-left">Car Details</h2>
                                <a href="create.php" class="btn btn-success pull-right" style="color:whitesmoke;">Add New Car</a>
                            </div>
                            <?php
                            
                            require_once "conntodb.php";
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM car";
                            if($result = mysqli_query($link, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    echo "<table class='table table-bordered table-striped'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>#</th>";
                                                echo "<th>Brand</th>";
                                                echo "<th>Model</th>";
                                                echo "<th>Price</th>";
                                                echo "<th>Stock</th>";
                                                echo "<th>Status</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['brand'] . "</td>";
                                                echo "<td>" . $row['model'] . "</td>";
                                                echo "<td>" . $row['price'] . "</td>";
                                                echo "<td>" . $row['stock'] . "</td>";
                                                echo "<td>" . $row['status'] . "</td>";
                                                echo "<td>";
                                                    echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye'></span></a>";
                                                    echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>";
                                                    echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span></a>";
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                            }

                            


                            ?>
                        </div>
                    </div>        
                </div>
            </div>
            
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix">
                                <br>
                                <h2 class="pull-left">Order Details</h2>
                            </div>
            
                            <?php
                            //for ORDERS and ORDER_DETAIL
                            $stmt = $link->prepare("SELECT os.id, charge_id, transaction_date, saleStatus, count(car_id) cars FROM orders os, order_detail od where os.id = od.order_id group by os.id");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>
                                <table class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction Date</th>
                                            <th>Charge ID</th>
                                            <th>Sale Status</th>
                                            <th>Count of Cars</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php

                            while($row = $result->fetch_assoc()) {

                                ?>
                                    <tr>
                                        <td><?php echo $row["id"]?></td>
                                        <td><?php echo $row["transaction_date"]?></td>
                                        <td><?php echo $row["charge_id"]?></td>
                                        <td><?php echo $row["saleStatus"]?></td>
                                        <td><?php echo $row["cars"]?></td>
                                        <td>
                                        <a href='orderMod.php?mod=upd&id=<?php echo $row["id"]?>&status=1' title='Update Status: Processed' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>
                                        <a href='orderMod.php?mod=upd&id=<?php echo $row["id"]?>&status=2' title='Update Status: Completed' data-toggle='tooltip'><span class='fa fa-pencil'></span></a>
                                        <a href='orderMod.php?mod=del&id=<?php echo $row["id"]?>' title='Delete Order' data-toggle='tooltip'><span class='fa fa-trash'></span></a>
                                        </td>
                                    </tr>                            
                                <?php
                            }

                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>        
                </div>
            </div>
        <?php
        }
        include "./includes/footer.php";
    ?>
</body>
</html>
