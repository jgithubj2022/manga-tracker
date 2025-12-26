<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
include "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row["password_hash"])) {
            $_SESSION["logged_in"] = true;
            $_SESSION["username"]  = $row["username"];
            $_SESSION["user_id"]   = (int)$row["id"];

            header("Location: index.php?my_library=1");
            exit;
        }
    }

    $error = "Invalid username or password!";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
    <style>
        body{
            font-family: 'Segoe UI', Tahoma;
            background-position: center;
            background-color: #101924ff;
            background-size: cover;
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #1f3247;
            padding: 30px;
            width: 320px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(255, 14, 14, 0.1);
            text-align: center;
        }
        h2{
            margin-bottom: 20px;
            color: #fff;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #1f3247;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button{
            width: 95%;
            padding: 10px;
            background: #0066cc;
            border:none;
            border-radius: 5px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
        .error{
            color: red;
            margin-top: 10px;
            font-size:14px;
        }
        .inputfonts {
            font-family: 'Segoe UI', Tahoma;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2><img src="nonmangaimages/manga_bite_logo.png" alt="Manga Logo" width="230" height ="70"></h2>

    <form method="POST">
        <input type="text" name="username" class="inputfonts" placeholder="USERNAME" required>
        <input type="password" name="password" class="inputfonts" placeholder="PASSWORD" required>
        <button type="submit" class="inputfonts">Login</button>
        <br>
        <br>
        <a class="create-link" href="create_account.php">Create Account</a>

    </form>

    <?php if (!empty($error)) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
</div>

</body>
</html>


