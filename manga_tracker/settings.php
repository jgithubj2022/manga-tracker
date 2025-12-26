<?php
require_once "auth.php";
require_login();
include "config.php";

$user_id = (int)$_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";
    if ($action === "change_username") {
        $current_user = trim($_POST["current_user"] ?? "");
        $new_user     = trim($_POST["new_user"] ?? "");
        // verify current username matches THIS logged-in user
        $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        if (!$row || $row["username"] !== $current_user) {
            header("Location: settings.php?err=bad_current_user");
            exit;
        }
        $stmt2 = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt2->bind_param("si", $new_user, $user_id);
        $stmt2->execute();
        header("Location: settings.php?msg=user_updated");
        exit;
    }
    if ($action === "change_password") {
        $current_password = $_POST["current_password"] ?? "";
        $new_password = $_POST["new_password"] ?? "";
        $stmt = $conn->prepare("SELECT password_hash FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        if (!$row || !password_verify($current_password, $row["password_hash"])) {
            header("Location: settings.php?err=bad_password");
            exit;
        }

        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt2 = $conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt2->bind_param("si", $new_hash, $user_id);
        $stmt2->execute();

        header("Location: settings.php?msg=pass_updated");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
  <title>Settings</title>
</head>

<body style="
  margin: 0;
  min-height: 100vh;
  background-color: #101924ff;
  background-size: cover;
  background-position: center;
  backdrop-filter: blur(5px);
  background-attachment: fixed;
">
  <main class="settings" style="
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    box-sizing: border-box;
  ">
    <div class="card" style="width: 100%; max-width: 1000px;">
      <h2>Settings</h2>
        <form method="POST">  
          <label>Change User:</label><br>
          <input type="hidden" name="action" value="change_username">
          <input type="text" name="current_user" placeholder="Current User" required>
          <input type="text" name="new_user" placeholder="New user" required>
          <button type="submit">Update Username</button>
        </form>
        <br>
        <form method="POST">
          <label>Change Password:</label><br>
          <input type="hidden" name="action" value="change_password">
          <input type="password" name="current_password" placeholder="Current password" required>
          <input type="password" name="new_password" placeholder="New password" required>
          <button type="submit">Update Password</button>
        </form>
        <br>
				<a class="settings-link" href="logout.php">Logout</a>
        <br>
				<a class="settings-link" href="delete_account.php">Delete Account</a>
        <br>

      <br>
      <a href="index.php?view_user=<?php echo (int)$_SESSION['user_id']; ?>&my_library= <?php echo (int)$_SESSION['user_id']; ?>  " a class="settings-cancel">Cancel</a>
    </div>
  </main>
</body>

</html>
