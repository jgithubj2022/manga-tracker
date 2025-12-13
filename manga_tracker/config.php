<?php
//$conn creates a connection of new mysqli($servername, $username, $password, $database);
//root is default in Xampp)
$conn = new mysqli("localhost", "root", "", "manga_tracker");
//check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
