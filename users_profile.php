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


$postQuery = "SELECT * FROM post WHERE id_user = $id";
$postResult = $conn->query($postQuery);

$posts = array();
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
                <div class="card-body">
                    <h5 class="card-title">User Profile</h5>
                    <p class="card-text">Username: <?php echo $username; ?></p>
                    <p class="card-text">First Name: <?php echo $firstName; ?></p>
                    <p class="card-text">Last Name: <?php echo $lastName; ?></p>
                    <p class="card-text">Date of Birth: <?php echo $dob; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h2>User Posts</h2>
            <?php foreach($posts as $post) { ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <?php echo $post['post_title']; ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $post['post_text']; ?></p>
                        <small class="text-muted">Posted on: <?php echo $post['created_at']; ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>