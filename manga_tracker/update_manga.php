<?php
require_once "auth.php";
require_login();
include "config.php";

$id      = (int)($_POST["id"] ?? 0);
$user_id = (int)($_SESSION["user_id"] ?? 0);

$title       = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$status      = trim($_POST["status"] ?? "Reading");
$ratingRaw   = $_POST["rating"] ?? "";           // "" means no rating
$rating      = ($ratingRaw === "") ? NULL : (int)$ratingRaw;

if ($id <= 0) {
    die("Invalid manga id.");
}
if ($title === "") {
    die("Title is required.");
}


$stmt = $conn->prepare("
  UPDATE mangas
  SET title = ?, description = ?, status = ?, rating = NULLIF(?, '')
  WHERE id = ? AND user_id = ?
");

$ratingForBind = ($rating === NULL) ? "" : (string)$rating;

$stmt->bind_param("ssssii", $title, $description, $status, $ratingForBind, $id, $user_id);
$stmt->execute();

header("Location: index.php?view_user=" . $user_id);
exit;
