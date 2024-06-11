<?php

    require_once "./database/connection.php";
    require_once "validation.php";  
    
    session_start();
    if(!isset($_SESSION["id"]))
    {
        header("Location: index.php");
    }

    $oldPassError = $newPassError = $retypeNewPassError = "";
    $sucMessage = "";
    $errMessage = "";

    $id = $_SESSION["id"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $oldPass = $conn->real_escape_string($_POST['old_password']);
        $newPass = $conn->real_escape_string($_POST['new_password']);
        $retypeNewPass = $conn->real_escape_string($_POST['retype_new_password']);

        $oldPassError = passwordValidation($oldPass);
        $newPassError = passwordValidation($newPass);
        $retypeNewPassError = passwordValidation($retypeNewPass);

        $q = "SELECT `password` FROM `users` WHERE `id` = $id;";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        $basePassword = $row['password'];

        
        if(!password_verify($oldPass, $basePassword)){
            $oldPassError = "Wrong password try again";
        }
        if($newPass !== $retypeNewPass){
            $retypeNewPassError = "You must enter to same passwords";
        }

        
        if($oldPassError == "" && $newPassError == "" && $retypeNewPassError == ""){
            $q = "";
            $hash = password_hash($newPass, PASSWORD_DEFAULT);
            $q = "UPDATE `users` SET `password` = '$hash' WHERE `id` = $id;";
            if($conn->query($q)){
                $sucMessage = "Your password has been successfully reset";
            } else{
                $errMessage = "We're sorry, but we were unable to reset your password";
            }
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<header>
    <?php require_once "header.php"; ?>
</header>
<section class="back-reset">
    <div class="container reset-pass">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body bg-container">
                        <h1 class="card-title text-center">Please reset the current password</h1>
                        <form action="#" method="post" class="reset"> 
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old password:</label>
                                <input type="password" name="old_password" id="old_password" class="form-control">
                                <span class="error"><?php echo $oldPassError ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New password:</label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                                <span class="error"><?php echo $newPassError ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="retype_new_password" class="form-label">Retype new password:</label>
                                <input type="password" name="retype_new_password" id="retype_new_password" class="form-control">
                                <span class="error"><?php echo $retypeNewPassError ?></span>
                            </div>
                            <div class="d-grid">
                                <input type="submit" class="btn btn-dark" value="Edit password">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="success">
                            <?php echo $sucMessage; ?>
                        </div>
                        <div class="error">
                            <?php echo $errMessage; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

