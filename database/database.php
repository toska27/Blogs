<?php

require_once "connection.php";

$sql = " CREATE TABLE IF NOT EXISTS `users`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `dob` DATE,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB; ";

$sql .= " CREATE TABLE IF NOT EXISTS `post`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `post_title` VARCHAR(255) NOT NULL,
    `post_text` TEXT NOT NULL,
    `created_at` DATETIME,
    `id_user` INT UNSIGNED NOT NULL,   
    PRIMARY KEY(`id`),
    FOREIGN KEY(`id_user`) REFERENCES `users`(`id`)
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB; ";

if($conn->multi_query($sql)) {          
    echo "<p>Tables created successfully</p>";
} else{
    header("Location: error.php?m=" . $conn->error);
}