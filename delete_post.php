<?php
session_start();
require_once "./database/connection.php";

if(empty($_SESSION['id'])){
    header("Location: index.php");    
}
$id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["post_id"])) {
        $post_id = $_POST["post_id"];

        $deleteQuery = "DELETE FROM post WHERE id = $post_id AND id_user = $id";
        
        if($conn->query($deleteQuery)) {
            header("Location: profile.php");
        } else {
            echo "Error deleting post: " . $conn->error;
        }
    } else {
        echo "Post ID not provided";
    }
} else {
    echo "Invalid request method";
}
?>
