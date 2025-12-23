<?php
require_once "auth.php";
require_login(); // only logged in users can access the add form
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
  <title>Add Manga</title>
</head>

<body style="
  margin: 0;
  min-height: 100vh;
  background-image: url('nonmangaimages/background.jpg?v=<?php echo time(); ?>');
  background-size: cover;
  background-position: center;
  backdrop-filter: blur(5px);
  background-attachment: fixed;
">
  <main class="edit-main" style="
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    box-sizing: border-box;
  ">
    <div class="card" style="width: 100%; max-width: 1000px;">
      <h2>Add Manga</h2>

      <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Manga Title" required><br><br>

        <textarea name="description" placeholder="Description"></textarea><br><br>

        <select name="status">
          <option value="Reading">Reading</option>
          <option value="Completed">Completed</option>
          <option value="Dropped">Dropped</option>
        </select><br><br>

        <label>Rating</label>
        <select name="rating">
          <option value="">No Rating</option>
          <option value="1">1/5</option>
          <option value="2">2/5</option>
          <option value="3">3/5</option>
          <option value="4">4/5</option>
          <option value="5">5/5</option>
        </select><br><br>

        <input type="file" name="cover" accept="image/*"><br><br>

        <button type="submit">Save</button>
      </form>

      <br>
      <a href="index.php?view_user=<?php echo (int)$_SESSION['user_id']; ?>&my_library= <?php echo (int)$_SESSION['user_id']; ?> ">View Manga</a>
    </div>
  </main>
</body>
</html>
