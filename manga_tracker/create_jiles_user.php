<?php
require_once "config.php";

$username = "jiles";
$passwordPlain = "smith";
$passwordHash = password_hash($passwordPlain, PASSWORD_DEFAULT);

// if user exists -> update password_hash
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
    $id = (int)$row["id"];

    $stmt2 = $conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $stmt2->bind_param("si", $passwordHash, $id);
    $stmt2->execute();

    echo "Updated password for 'jiles' (password is now 'smith').";
    exit;
}

// eles -> insrt new user
$stmt3 = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
$stmt3->bind_param("ss", $username, $passwordHash);
$stmt3->execute();

echo "User 'jiles' created successfully (password: smith).";
