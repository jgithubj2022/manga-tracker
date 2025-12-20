<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$status = $_POST['status'];
$rating = $_POST['rating'];
if ($rating === "") { //if empty rating set to NULL
    $rating = NULL;
}

$stmt = $conn->prepare(
    "UPDATE mangas SET title = ?, description = ?, status = ?, rating = ? WHERE id = ?"//included Set rating = ?
);
$stmt->bind_param("sssii", $title, $description, $status, $rating, $id);//bind 5 params s-string, s-string, s-string, i-integer, i-integer added second integer for rating!
$stmt->execute(); //lastly execute after binding 4 params must have the user input in the prepared function or its  STILL vulnerable sql injection 

header("Location: index.php");
