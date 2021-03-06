<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Car Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
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
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add a car record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($brand_err)) ? 'has-error' : ''; ?>">
                            <label>Brand</label>
                            <input type="text" name="brand" class="form-control" value="<?php echo $brand; ?>">
                            <span class="help-block"><?php echo $brand_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($model_err)) ? 'has-error' : ''; ?>">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control" value="<?php echo $model; ?>">
                            <span class="help-block"><?php echo $model_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($stock_err)) ? 'has-error' : ''; ?>">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" value="<?php echo $stock; ?>">
                            <span class="help-block"><?php echo $stock_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <input type="number" min="1" max="4" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block"><?php echo $status_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<?php
        }
require_once "conntodb.php";
 
// Define variables and initialize with empty values
$brand = $model = $price = $stock = $status = $description = "";
$brand_err = $model_err = $price_err = $stock_err = $status_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_description = trim($_POST["description"]);
    $description = $input_description;
    
    $input_brand = trim($_POST["brand"]);
    if(empty($input_brand)){
        $brand_err = "Please enter the brand.";     
    } else{
        $brand = $input_brand;
    }
    
    $input_model = trim($_POST["model"]);
    if(empty($input_model)){
        $model_err = "Please enter the model.";     
    } else{
        $model = $input_model;
    }
    
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";     
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }
    
    $input_stock = trim($_POST["stock"]);
    if(empty($input_stock)){
        $stock_err = "Please enter the stock amount.";     
    } elseif(!ctype_digit($input_stock)){
        $stock_err = "Please enter a integer value.";
    } else{
        $stock = $input_stock;
    }
    
    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $status_err = "Please enter the status.";     
    } elseif(!ctype_digit($input_status)){
        $status_err = "Please enter a positive integer value.";
    } else{
        $status = $input_status;
    }
    
    // Check input errors before inserting in database
    if(empty($price_err) && empty($stock_err) && empty($status_err) && empty($brand_err) && empty($model_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO car (brand, model, price, stock, status, description) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_brand, $param_model, $param_price, $param_stock, $param_status, $param_description);
            
            // Set parameters
            $param_brand = $brand;
            $param_model = $model;
            $param_price = $price;
            $param_stock = $stock;
            $param_status = $status;
            $param_description = $description;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: admin.php");
                exit();
            } else{
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>