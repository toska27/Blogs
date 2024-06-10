<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php
    if(isset($_SESSION["username"])) { // user logged?
        echo                               
        "
        <nav class='navbar navbar-expand-lg navbar-dark bg-secondary '>
            <div class='container '>
            
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ms-auto'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='reset_password.php'>Reset password</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='logout.php'>Log out</a>
                        </li>
                    
                    </ul>
                </div>
            </div>
        </nav>";
    } else {
        echo 
        "<nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
            <div class='container'>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ms-auto'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='login.php'>Login</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='register.php'>Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>";
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

