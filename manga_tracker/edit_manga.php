<?php
require_once "auth.php";
require_login();
include "config.php";

$id = (int)($_GET["id"] ?? 0);
$user_id = (int)$_SESSION["user_id"];

$stmt = $conn->prepare("SELECT * FROM mangas WHERE id = ? AND user_id = ? LIMIT 1");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$manga = $result->fetch_assoc();

if ($result->num_rows === 0) {
  // either not found, or not yours
  header("Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
  <title>Edit Manga</title>
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
    <div class="card" style="width: 100%; max-width: 1000px;">
      

    <div class="card-edit">
      <h2>Edit Manga</h2>
      <form action="update_manga.php" method="POST">
        <input type="hidden" name="id" value="<?php echo (int)$manga['id']; ?>">

        <input type="text" name="title"
          value="<?php echo htmlspecialchars($manga['title'] ?? ''); ?>"
          required><br><br>

        <textarea name="description"><?php echo htmlspecialchars($manga['description'] ?? ''); ?></textarea><br><br>

        <select name="status">
          <option value="Reading"   <?php if (($manga['status'] ?? '') === "Reading") echo "selected"; ?>>Reading</option>
          <option value="Completed" <?php if (($manga['status'] ?? '') === "Completed") echo "selected"; ?>>Completed</option>
          <option value="Dropped"   <?php if (($manga['status'] ?? '') === "Dropped") echo "selected"; ?>>Dropped</option>
        </select><br><br>

        <label>Rating</label>
        <select name="rating">
          <option value="" <?php if ($manga['rating'] === NULL || $manga['rating'] === '') echo "selected"; ?>>No Result</option>
          <option value="1" >1 / 5</option>
          <option value="2" >2 / 5</option>
          <option value="3" >3 / 5</option>
          <option value="4">4 / 5</option>
          <option value="5">5 / 5</option>
        </select><br><br>

        <button type="submit">Update</button>
      </form>

      <br>
        <a class="cancel" href="index.php?view_user=<?php echo (int)$_SESSION['user_id']; ?>&my_library= <?php echo (int)$_SESSION['user_id']; ?> ">Cancel</a>
    </div>
    </div>
  </main>
</body>
</html>

