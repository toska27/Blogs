<?php
    session_start(); 

    if(isset($_SESSION["id"])){
        header("Location: index.php");           
    }
    
    require_once "./database/connection.php";

    $usernameError = "";
    $passwordError = "";
    $username = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $conn->real_escape_string($_POST["password"]);

        if(empty($username)){
            $usernameError = "Username cannot be blank!";      
        }

        if(empty($password)){
            $passwordError = "Password cannot be blank!";     
        }

        if($usernameError == "" && $passwordError == ""){   

            
            $q = "SELECT `id`, `username`, `password` FROM `users` WHERE `username`='$username'"; 
            $result = $conn->query($q);        

            if($result->num_rows == 0){       
                $usernameError = "This username doesn't exist!";
            } else{

                $row = $result->fetch_assoc();  

                $dbPassword = $row["password"];         
                if(!password_verify($password, $dbPassword)){      
                    $passwordError = "Wrong password, try again!";
                } else{
                    $_SESSION["id"] = $row["id"];           
                    $_SESSION["username"] = $row["username"];

                    header("Location: index.php");         
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<header>
    <?php require_once "header.php"; ?>
</header>
<section class="back-login">
    <div class="container login">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body bg-container">
                        <form action="#" method="post" class="form-login">
                            <h1 class="card-title text-center">Please login</h1>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                                <span class="error"><?php echo $usernameError; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <span class="error"><?php echo $passwordError; ?></span>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Login" class="btn btn-dark">
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
