<?php
session_start();
require_once "./database/connection.php";

if(empty($_SESSION['id'])){
    header("Location: index.php");    
}
$id = $_SESSION["id"];


$userQuery = "SELECT * FROM users WHERE id = $id";
$userResult = $conn->query($userQuery);
$userData = $userResult->fetch_assoc();


$username = $userData['username'];
$firstName = $userData['first_name'];
$lastName = $userData['last_name'];
$dob = $userData['dob'];


$postQuery = "SELECT * FROM post WHERE id_user = $id ORDER BY `created_at` DESC";
$postResult = $conn->query($postQuery);
$posts = [];
while($post = $postResult->fetch_assoc()) {
    $posts[] = $post;
}
             
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<header>
    <?php require_once "header.php"; ?>
</header>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-container">
                    <h3 class="card-title">My Profile</h3>
                    <p class="card-text">Username: <strong><?php echo $username; ?></strong></p>
                    <p class="card-text">First Name: <strong><?php echo $firstName; ?></strong></p>
                    <p class="card-text">Last Name: <strong><?php echo $lastName; ?></strong></p>
                    <p class="card-text">Date of Birth: <strong><?php echo $dob; ?></strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h2 class='title_my_profile'>My Posts</h2>
            <?php if(empty($posts)) { ?>
                <div class="alert alert-danger" role="alert">
                    No posts found.
                </div>
            <?php } else { ?>
                <?php foreach($posts as $post) { ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5><?php echo htmlspecialchars($post['post_title']); ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($post['post_text']); ?></p>
                            <small class="text-muted">Posted on: <?php echo htmlspecialchars($post['created_at']); ?></small>
                        </div>
                        <div class="card-footer">
                            <form action="delete_post.php" method="post">
                                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

