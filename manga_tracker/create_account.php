<?php
session_start();
include "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm  = $_POST["confirm"] ?? "";

    // Basic validation
    if ($username === "" || $password === "" || $confirm === "") {
        $error = "Please fill in all fields.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $error = "Username must be 3-20 chars (letters/numbers/_).";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->fetch_assoc()) {
            $error = "Username already taken.";
        } else {
            // Create user
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);

            if ($stmt->execute()) {
                $newId = (int)$conn->insert_id;

                // Log them in immediately
                $_SESSION["logged_in"] = true;
                $_SESSION["username"]  = $username;
                $_SESSION["user_id"]   = $newId;

                header("Location: index.php?my_library=1");
                exit;
            } else {
                $error = "Account creation failed. Try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
  <title>Create Account</title>
</head>
<body style="
    margin: 0;
    min-height: 100vh;
    background-color: #101924ff;
    background-size: cover;
    background-position: center;
    backdrop-filter: blur(5px);
    background-attachment: fixed;">

  <main class="edit-main" style="
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px 20px;
      box-sizing: border-box;">

    <div class="card-edit" style="width: 100%; max-width: 520px;">
      <h2>Create Account</h2>

      <?php if ($error !== ""): ?>
        <p style="color: #ff6b6b; margin: 10px 0;"><?php echo htmlspecialchars($error); ?></p>
      <?php endif; ?>

      <form method="POST" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>

        <button type="submit">Create Account</button>
      </form>

      <br>
      <a href="login.php">Back to Login</a>
    </div>
  </main>
</body>
</html>

