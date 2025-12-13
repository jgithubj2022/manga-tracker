<?php
include "config.php";
//include connection, this file is for uploading with backend file
//to be stored it is never visited in hyperlink directly
$title = $_POST['title']; //$_POST gets data from form in add_manga.php
$description = $_POST['description'];
$status = $_POST['status']; //status from dropdown all three prompts in add_manga in php variables for recalling!

$imageName = $_FILES['cover']['name'];
$imageTmp = $_FILES['cover']['tmp_name'];
$target = "uploads/" . basename($imageName);//img names stored in uploads folder

if (move_uploaded_file($imageTmp, $target)) {
    $sql = "INSERT INTO mangas (title, description, status, cover_image)
            VALUES ('$title', '$description', '$status', '$imageName')";
    $conn->query($sql);//cant use without including config.php connection
}

header("Location: index.php");
?>
