<?php
$message = "";
    if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['m'])) {  
        $message = $_GET['m'];       
    }
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="./style/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="card-title text-danger text-center">Oops! An error occurred!</h1>
                        <div class="alert alert-danger mt-4" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                        <div class="text-center mt-3">
                            <a href="index.php" class="btn btn-primary">Return to Home Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>