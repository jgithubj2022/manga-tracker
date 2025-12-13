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

$stmt = $conn->prepare(
    "UPDATE mangas SET title = ?, description = ?, status = ? WHERE id = ?"
);
$stmt->bind_param("sssi", $title, $description, $status, $id);
$stmt->execute(); //lastly execute after binding 4 params must have the user input in the prepared function or its  STILL vulnerable sql injection 

header("Location: index.php");
