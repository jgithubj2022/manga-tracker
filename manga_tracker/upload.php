<?php
require_once "auth.php";
require_login();
include "config.php";

$user_id = (int)$_SESSION["user_id"];

$title       = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$status      = trim($_POST["status"] ?? "");
$rating      = $_POST["rating"] ?? ""; // may be "" (No Rating)

if ($title === "") {
    die("Title is required.");
}

/* handle file upload */
$coverFileName = ""; // store "" -> NULL in SQL using NULLIF
if (!empty($_FILES["cover"]["name"]) && ($_FILES["cover"]["error"] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
    $tmp  = $_FILES["cover"]["tmp_name"];
    $ext  = strtolower(pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION));

    $allowed = ["jpg", "jpeg", "png", "webp"];
    if (!in_array($ext, $allowed, true)) {
        die("Invalid file type.");
    }

    $coverFileName = uniqid("cover_", true) . "." . $ext;
    $dest = __DIR__ . "/uploads/" . $coverFileName;

    if (!move_uploaded_file($tmp, $dest)) {
        die("Failed to upload image.");
    }
}

/* insert manga with user_id*/
$stmt = $conn->prepare("
    INSERT INTO mangas (title, description, status, rating, cover_image, user_id)
    VALUES (?, ?, ?, NULLIF(?, ''), NULLIF(?, ''), ?)
");
$stmt->bind_param("sssssi", $title, $description, $status, $rating, $coverFileName, $user_id);
$stmt->execute();

header("Location: index.php?my_library=1");
exit;
