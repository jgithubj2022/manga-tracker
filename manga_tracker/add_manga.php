<!DOCTYPE html> <!-- add_manga.php through php file to web connection add manga-->
<html>
<head>
    <link rel="stylesheet" href="style.css"> <!--- link to css file-->  
    <title>Add Manga</title>
</head>
<body>
<h2>Add Manga</h2>
<!-- when submitted data from here goes to upload.php with POST method-->
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Manga Title" required><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <select name="status">
        <option value="Reading">Reading</option>
        <option value="Completed">Completed</option>
        <option value="Dropped">Dropped</option>
    </select><br><br>
    <label>Rating</label>
    <select name = rating>
        <option value="">No Rating</option>
        <option value="1">1/5</option>
        <option value="2">2/5</option>
        <option value="3">3/5</option>
        <option value="4">4/5</option>
        <option value="5">5/5</option>
    </select><!-- added rating selection --><br><br>

    <input type="file" name="cover"><br><br>

    <button type="submit">Save</button>
</form>

<a href="index.php">View Manga List</a>
</body>
</html>
