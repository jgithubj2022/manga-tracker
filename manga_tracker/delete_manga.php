<?php
require_once "auth.php";
require_login();
include "config.php";

$id = (int)($_POST["id"] ?? 0);
$user_id = (int)($_SESSION["user_id"] ?? 0);

if ($id <= 0 || $user_id <= 0) {
    header("Location: index.php");
    exit;
}
$stmt = $conn->prepare("SELECT cover_image FROM mangas WHERE id = ? AND user_id = ? LIMIT 1");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    // manga doesn't exist or doesn't belong to this user
    header("Location: index.php");
    exit;
}

//dlete the image file if exists
if (!empty($row["cover_image"])) {
    $path = __DIR__ . "/uploads/" . $row["cover_image"];
    if (file_exists($path)) {
        @unlink($path);
    }
}

//delete the record only belonging to this user
$stmt = $conn->prepare("DELETE FROM mangas WHERE id = ? AND user_id = ? LIMIT 1");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$stmt->close();

header("Location: index.php?view_user=" . (int)$_SESSION["user_id"]);
exit;
