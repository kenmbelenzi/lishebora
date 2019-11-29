<?php
// Include config file
require_once "database/db.php";

// Define variables and initialize with empty values
$username = $email = $vkey = "";
$username_err = $email_err = $vkey_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $usernamr_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $username = $input_name;
    }

    // Validate address address
    $email = trim($_POST["email"]);
    if(empty($input_address)){
        $email_err = "Please enter an email address.";
    } else{
        $email = $input_address;
    }

    // Validate salary
    $vkey = trim($_POST["vkey"]);
    if(empty($input_salary)){
        $vkey_err = "Please enter the verification key.";
    }
     else{
        $vkey = $input_salary;
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($vkey_err)){
        // Prepare an update statement
        $sql = "UPDATE register_user SET username=:username, email=:email, vkey=:vkey WHERE id=:id";

        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":vkey", $param_vkey);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_username = $name;
            $param_email= $email;
            $param_vkey = $vkey;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM register_user WHERE id = :id";
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $username = $row["username"];
                    $email = $row["email"];
                    $vkey = $row["vkey"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email Address</label>
                        <textarea name="address" class="form-control"><?php echo $email; ?></textarea>
                        <span class="help-block"><?php echo $email_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($vkey_err)) ? 'has-error' : ''; ?>">
                        <label>Verification key</label>
                        <input type="text" name="salary" class="form-control" value="<?php echo $vkey; ?>">
                        <span class="help-block"><?php echo $vkey_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
