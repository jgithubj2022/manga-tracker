<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = $_POST['id'];

// (Optional) fetch image name first to delete file
$stmt = $conn->prepare("SELECT cover_image FROM mangas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!empty($row['cover_image'])) {
    $path = "uploads/" . $row['cover_image'];
    if (file_exists($path)) {
        unlink($path);
    }
}

// delete record
$stmt = $conn->prepare("DELETE FROM mangas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
