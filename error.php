<?php
$message = "";
    if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['m'])) {  
        $message = $_GET['m'];       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
</head>
<body>
    <h1>Ooops! An error occured!</h1>
    <div class="error">
        <?php echo $message; ?>
    </div>
    Return to <a href="index.php">home page</a>.
</body>
</html>