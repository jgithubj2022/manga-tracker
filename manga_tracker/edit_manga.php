<?php
include "config.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM mangas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$manga = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css"><!--- link to css file-->   
    <title>Edit Manga</title>
</head>
<body>

<h2>Edit Manga</h2>

<form action="update_manga.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $manga['id']; ?>">

    <input type="text" name="title" value="<?php echo htmlspecialchars($manga['title']); ?>" required><br><br>

    <textarea name="description"><?php echo htmlspecialchars($manga['description']); ?></textarea><br><br>

    <select name="status">
        <option value="Reading" <?php if ($manga['status']=="Reading") echo "selected"; ?>>Reading</option>
        <option value="Completed" <?php if ($manga['status']=="Completed") echo "selected"; ?>>Completed</option>
        <option value="Dropped" <?php if ($manga['status']=="Dropped") echo "selected"; ?>>Dropped</option>
    </select><br><br>
    <label>Rating</label>
    <select name = rating>
        <option value="" <?php if ($manga['rating']===NULL) echo "selected"; ?>>No Rating</option>
        <option value="1">1/5</option>
        <option value="2">2/5</option>
        <option value="3">3/5</option>
        <option value="4">4/5</option>
        <option value="5">5/5</option>
    </select><!-- added rating selection --><br><br>

    <button type="submit">Update</button>
</form>

<a href="index.php">Cancel</a>

</body>
</html>
