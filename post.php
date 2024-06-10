<?php
session_start();
if(empty($_SESSION['id'])){
    header("Location: index.php");    
}
$id = $_SESSION["id"];     

require_once "./database/connection.php";

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_title = $conn->real_escape_string($_POST["post_title"]); 
    $post_text = $conn->real_escape_string($_POST["post_text"]); 
    $created_at = date('Y-m-d H:i:s');

    $successMsg = '';
    $errorMsg = '';
    if (empty($post_title) || empty($post_text)) {
        $errorMsg = "All fields are required.";
    } 

    if($errorMsg == ''){
        $q = "INSERT INTO `post`(`post_title`, `post_text`, `created_at`, `id_user`) VALUES
        ('$post_title', '$post_text', '$created_at', '$id');";

        if($conn->query($q)){             
            $successMsg = "Blog added successfully.";  
        } else{
            header("Location: error.php?" . http_build_query(['m' => "Error when adding post"])); 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php require_once "header.php"; ?>
    </header>
    <div class="container">
        <h2 class="mt-5">Add new blog</h2>
        <?php
        if (!empty($errorMsg)) {
            echo "<div class='alert alert-danger'>$errorMsg</div>";
        }
        if (!empty($successMsg)) {
            echo "<div class='alert alert-success' id='successMessage'>$successMsg</div>";
        }
        ?>
        <form action="post.php" method="post">
            <div class="form-group">
                <label for="post_title">Blog title:</label>
                <input type="text" name="post_title" id="post_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="post_text">Blog text:</label>
                <textarea name="post_text" id="post_text" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000); 
        });

        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    </script>
</body>
</html>