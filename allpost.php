<?php

require_once 'database/connection.php';

$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'time';

$validSortOptions = ['time', 'first_name'];
if (!in_array($sortBy, $validSortOptions)) {
    $sortBy = 'time'; 
}

if ($sortBy === 'time') {
    $sql = 'SELECT post.*, users.first_name, users.last_name FROM post JOIN users ON post.id_user = users.id ORDER BY post.created_at DESC';
} else {
    $sql = 'SELECT post.*, users.first_name, users.last_name FROM post JOIN users ON post.id_user = users.id ORDER BY users.username';
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>All Posts</title>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body>
    <header>
        <?php require_once "header.php"; ?>
    </header>
    <div class='container mt-5'>
        <h1 class='mb-4'>All Posts</h1>

        <div class="mb-3">
            <label for="sort">Sort by:</label>
            <select class="form-select" id="sort" onchange="location = this.value;">
                <option value="allpost.php?sort=time" <?php echo ($sortBy === 'time') ? 'selected' : ''; ?>>Time</option>
                <option value="allpost.php?sort=first_name" <?php echo ($sortBy === 'name') ? 'selected' : ''; ?>>Name</option>
            </select>
        </div>

        <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card mb-3'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['post_title']}</h5>
                                <p class='card-text'>{$row['post_text']}</p>
                                <p class='card-text'><small class='text-muted'>Posted by: {$row['first_name']} {$row['last_name']}</small></p>
                            </div>
                        </div>";
                }
            } else {
                echo "<p>No posts found.</p>";
            }
        ?>
</div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>

