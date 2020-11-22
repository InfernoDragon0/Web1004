<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['memberid']) || !$_SESSION['isAdmin']) {
            header('HTTP/1.0 403 Forbidden');
            echo "<h1>Forbidden</h1>";
            echo "You must have admin privileges to access this page.";
        }
        else {
            ?>

            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <h2 class="pull-left">Car Details</h2>
                                <a href="create.php" class="btn btn-success pull-right">Add New Car</a>
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
                                                    echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                    echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
            <?php
        }
    ?>
</body>
</html>
