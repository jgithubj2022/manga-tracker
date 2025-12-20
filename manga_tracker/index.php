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
    <!--- link to css file i changed to v = php echo time since the time changes constantly and therefore css will always be recently uploaded-->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" /> 
    <title>Manga Tracker</title>
</head>
<body>
    <label for="bgInput" class="bg-upload-zone"></label>

    <form id="bgUploadForm" action="upload_background.php" method="POST" enctype="multipart/form-data">
        <input
            type="file"
            name="background"
            id="bgInput"
            accept="image/png, image/jpeg"
            hidden
        >
    </form>


    <div class="main-content">
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
        <!-- Hidden upload form -->


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
                        <div class="manga-rating">
                            Rating: 
                            <?php 
                            if ($row['rating'] === NULL) {
                                echo "No Rating";
                            } else {
                                echo htmlspecialchars($row['rating']) . "/5 ★";
                            }
                            ?>
                        </div> <!-- previously used span but I dont want it inline-->
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

    </div>
</body>
</html>

<script>

document.getElementById("bgInput").addEventListener("change", () => {
    document.getElementById("bgUploadForm").submit();
});
</script>

<style> /*background image gets replaced live instead of when vs-code reloads, I used to do the css for the 
updated background image inside of style.css but changed it to here in the .php file so it updated live since browser
READS CSS before page loads meaning it cannot be edited afterward*/
body {
    background-image: url("nonmangaimages/background.jpg?v=<?php echo time(); ?>");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    backdrop-filter: blur(5px);
}
</style>