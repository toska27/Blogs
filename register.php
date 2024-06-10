<?php
    
    session_start();
    if(isset($_SESSION["id"])){            // do not allow access to logged in users
        header("Location: index.php");
    }

    require_once "./database/connection.php";
    require_once "validation.php";

    $usernameError = "";
    $passwordError = "";
    $retypeError = "";
    $firstNameError = "";
    $lastNameError = "";
    $dobError = "";
    $username = $password = $retype = $first_name = $last_name = $dob = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){       

        $username = $conn->real_escape_string($_POST["username"]);  
        $password = $conn->real_escape_string($_POST["password"]);
        $retype = $conn->real_escape_string($_POST["retype"]);
        $first_name = $conn->real_escape_string($_POST["first_name"]);
        $last_name = $conn->real_escape_string($_POST["last_name"]);
        $dob = $conn->real_escape_string($_POST["dob"]);

      
        $usernameError = usernameValidation($username, $conn);
        $passwordError = passwordValidation($password);
        $retypeError = passwordValidation($retype);
        if($password !== $retype){
            $retypeError = "You must enter to same passwords";
        }
        $firstNameError = nameValidation($first_name);
        $lastNameError = nameValidation($last_name);
        $dobError = dobValidation($dob);

        // If all input is valid, add new user
        if($usernameError == "" && $passwordError == "" && $retypeError=="" && $firstNameError == "" && $lastNameError == "" && $dobError == ""){
            
            $hash = password_hash($password, PASSWORD_DEFAULT);           

            $q = "INSERT INTO `users`(`username`, `password`, `first_name`, `last_name`, `dob`) VALUE       
            ('$username', '$hash', '$first_name', '$last_name', '$dob');";                                    

            if($conn->query($q)){             
                header("Location: index.php?p=ok");   
            } else{
                header("Location: error.php?" . http_build_query(['m' => "Greska kod kreiranja usera"])); 
            }
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register new user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    
<section class="back-register">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Register to our site</h1>
                        <form action="register.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
                                <span class="error"><?php echo $usernameError; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" value="">
                                <span class="error"><?php echo $passwordError; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="retype" class="form-label">Retype password:</label>
                                <input type="password" name="retype" id="retype" class="form-control" value="">
                                <span class="error"><?php echo $retypeError; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name ?>">
                                <span class="error"><?php echo $firstNameError; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $last_name ?>">
                                <span class="error"><?php echo $lastNameError; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth:</label>
                                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $dob ?>">
                                <span class="error"><?php echo $dobError; ?></span>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Register me!" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
