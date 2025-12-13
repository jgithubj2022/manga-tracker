<?php
if (!isset($_FILES['background'])) {
    header("Location: index.php");
    exit;
}

$file = $_FILES['background'];
$allowedTypes = ['image/jpeg', 'image/png'];

if (!in_array($file['type'], $allowedTypes)) {
    die("Only JPG and PNG allowed.");
}

$target = "nonmangaimages/background.jpg";

//overwrite existing background
move_uploaded_file($file['tmp_name'], $target);

header("Location: index.php");
exit;
