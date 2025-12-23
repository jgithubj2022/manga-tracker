<?php
require_once "config.php";
require_once "auth.php";
require_login();

$error = "";
$success = "";

$user_id = (int)$_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['password'] ?? '';

    // fetch pas hash
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$row = $result->fetch_assoc()) {
        $error = "User not found.";
    } else {
        //verify password
        if (!password_verify($password, $row['password_hash'])) {
            $error = "Incorrect password.";
        } else {
            // delete user's mangas
            $stmt = $conn->prepare("DELETE FROM mangas WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            // delete user account
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            // destroy session
            session_unset();
            session_destroy();

            // redirect to login
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Delete Account</title>
</head>
<body>

<div class="card-edit">
    <h2>Delete Account</h2>
    <p style="color:#ff6b6b;">
        This action is permanent. All your manga will be deleted.
    </p>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <input
            type="password"
            name="password"
            placeholder="Confirm your password"
            required
        >
        <button type="submit" style="background:#8b1e1e;">
            Delete My Account
        </button>
    </form>

    <br>
    <a href="index.php">Cancel</a>
</div>

</body>
</html>
