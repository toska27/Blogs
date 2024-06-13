<?php 
    session_start();
    require_once "./database/connection.php";
    require_once "validation.php";

    $message = "";
    if (isset($_GET["m"]) && $_GET["m"] == "ok"){                          
        $message = "You have successfully registred, please login to continue";     
    }

    $username = "";
    if(isset($_SESSION["username"])){                
        $username = $_SESSION["username"];                   
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <header>
        <?php require_once "header.php"; ?>
    </header>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body bg-container">
                        <h1 class="fw-bold text-center">Welcome <?php echo htmlspecialchars($username); ?> to our Blogs application!</h1>
                        <?php if(isset($_SESSION["username"])) { ?>
                            <div class="d-grid gap-2 mt-4">
                                <a href="my_profile.php" class="btn btn-dark  index-btn">View your profile</a>
                                <a href="all_posts.php" class="btn btn-dark  index-btn">View all blogs</a>
                                <a href="add_post.php" class="btn btn-dark  index-btn">Add new blog</a>
                            </div>
                        <?php } else { ?>
                            <div class="container mt-5 ">
                                <div class="row justify-content-center ">
                                    <div class="col-md-6 ">
                                        <div class="card text-center ">
                                            <div class="card-body login-register">
                                                <h5 class="card-title fw-bold">New to our site?</h5>
                                                <p class="card-text">Register here to access our site</p>
                                                <a href="register.php" class="btn btn-secondary mb-3">Register</a>
                                                <h5 class="card-title fw-bold">Already have an account?</h5>
                                                <p class="card-text">Login here to continue to our site</p>
                                                <a href="login.php" class="btn btn-secondary">Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if(!empty($message)) { ?>
                            <div class="alert alert-success mt-3 msg" role="alert" id='msg'>
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let msg = document.getElementById('msg');
                if (msg) {
                    msg.style.display = 'none';
                }
            }, 3000); 
        });

        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    </script>
</body>
</html>
