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
            header("Location: my_profile.php");
        } else {
            header("Location: error.php?" . http_build_query(['m' => "Error deleting post"])); 
        }
    } else {
        header("Location: error.php?" . http_build_query(['m' => "Post ID not provided"])); 
    }
} else {
    header("Location: error.php?" . http_build_query(['m' => "Invalid request method"]));
}
?>
