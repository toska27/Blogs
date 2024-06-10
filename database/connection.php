<?php

$host = 'localhost';
$user = 'blogs';
$pass = 'blogs123';
$db = 'blogs';

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed." . $conn->connect_error);
} 