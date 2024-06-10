<?php 
    session_start();
    require_once "./database/connection.php";
    require_once "validation.php";

    $message = "";
    if (isset($_GET["p"]) && $_GET["p"] == "ok"){                          
        $message = "You have successfully registred, please login to continue";     
    }

    $username = "anonymus";
    if(isset($_SESSION["username"])){                
        $username = $_SESSION["username"];                   
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" version="2.1">
</head>
<body>
    <header>
        <?php require_once "header.php"; ?>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold">Welcome, <?php echo $username?>, to our Blogs application!</h1>
                <?php if(isset($_SESSION["username"])) { ?>
                    <p><a href="profile.php" class="btn btn-primary">View your profile</a></p>
                    <p><a href="post.php" class="btn btn-primary">Add new blog</a></p>
                    <p><a href="allpost.php" class="btn btn-primary">View all blogs</a></p>
                <?php } else { ?>
                    <p class="fw-bold">New to our site? <br> <a href="register.php" class="text-decoration-none">Register here</a> to access our site</p>
                    <p class="fw-bold">Already have an account? <br> <a href="login.php" class="text-decoration-none">Login here</a> to continue to our site</p>
                <?php } ?>
                    
                <?php if(!empty($message)) { ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?php echo $message ?>
                    </div> 
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
