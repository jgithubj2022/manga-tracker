<?php
include "config.php";

/*
  1.check if a search term exists
  2.if yes filter results
  3.if no show all manga
*/

//default search value in searchbar for nthn
$search = "";

//check if search was submitted
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

//prepare SQL, if search not empty
if ($search !== "") {
    //search query
    $stmt = $conn->prepare(//connction from config.php
        "SELECT * FROM mangas WHERE title LIKE ? ORDER BY date_added DESC"
    );
    $like = "%" . $search . "%";
    $stmt->bind_param("s", $like);
} else {
    //show all manga
    $stmt = $conn->prepare(
        "SELECT * FROM mangas ORDER BY date_added DESC"
    );
}

//execute query
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css"><!--- link to css file-->
    <title>Manga Tracker</title>
</head>
<body>

<!-- old header <h1>My Manga Tracker</h1> -->
<img src="nonmangaimages/manga_logo.png" alt="Manga Logo" width="150">

<!-- SEARCH BAR -- made through html-->
<form method="GET" action="index.php">
    <input 
        type="text" 
        name="search" 
        placeholder="Search manga..."
        value="<?php echo htmlspecialchars($search); ?>"
    >
    <button type="submit">Search</button>
</form>

<br>

<a href="add_manga.php">+ Add Manga</a>
<hr><!-- horizontal line-->

<!-- DISPLAY MANGA LIST DISPLAYS MANGA LIST BELOW AND BACK TO PHP-->


<?php
//display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { //each row has data relating to edit and delete
    ?>
    <div class="manga-card">

        <div class="manga-cover">
            <?php if (!empty($row['cover_image'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($row['cover_image']); ?>">
            <?php endif; ?>
        </div>

        <div class="manga-info">
            <div class="manga-title">
                <?php echo htmlspecialchars($row['title']); ?>
            </div>

            <div class="manga-status">
                Status: <?php echo htmlspecialchars($row['status']); ?>
            </div>

            <p class="manga-description">
                <?php echo htmlspecialchars($row['description']); ?>
            </p>

            <div class="manga-actions">
                <form action="edit_manga.php" method="GET" class="edit-form">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="edit-btn">
                        Edit
                    </button>
                </form>


                <form action="delete_manga.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button 
                        type="submit" 
                        class="delete-btn"
                        onclick="return confirm('Delete this manga?')"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>

    </div>
    <?php
}

} else {
    echo "<p>No manga found.</p>";
}
?>

</body>
</html>
