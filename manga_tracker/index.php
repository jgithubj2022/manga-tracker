<?php
include "config.php";
require_once "auth.php";

/*
  public viewing:
  -anyone can view a user's library via ?view_user=ID
  -logged-in users default to viewing their own library
  -guests with no view_user selected will see no mangas
*/

// Manga title search within selected user's library
$search = trim($_GET['search'] ?? "");

// Username search (find users)
$user_search = trim($_GET['user_search'] ?? "");

// Which user's library are we viewing?
$view_user = (int)($_GET['view_user'] ?? 0);

// If logged in and no user selected, default to your own library
if ($view_user === 0 && is_logged_in()) {
    $view_user = (int)$_SESSION['user_id'];
}



/* USER SEARCH RESULTS clickable list */
$userResults = null;
if ($user_search !== "") {
    $likeUser = $user_search . "%";
    $stmtUsers = $conn->prepare("SELECT id, username FROM users WHERE username LIKE ? ORDER BY username LIMIT 15");
    $stmtUsers->bind_param("s", $likeUser);
    $stmtUsers->execute();
    $userResults = $stmtUsers->get_result();
}

/* MANGA RESULTS filtered by selected user_id*/
if ($view_user > 0) {
    if ($search !== "") {
        $stmt = $conn->prepare("SELECT * FROM mangas WHERE user_id = ? AND title LIKE ? ORDER BY date_added DESC");
        $like = "%" . $search . "%";
        $stmt->bind_param("is", $view_user, $like);
    } else {
        $stmt = $conn->prepare("SELECT * FROM mangas WHERE user_id = ? ORDER BY date_added DESC");
        $stmt->bind_param("i", $view_user);
    }

} else {
    //guest with no user selected: show nothing
    $stmt = $conn->prepare("SELECT * FROM mangas WHERE 1=0");
}
//manga comments section sending comments to database not yet implemented
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comments"])) {
    if (!is_logged_in()) {
        echo "<script>alert('You must be logged in to post comments.'); window.location.href='index.php';</script>";
        exit;
    }

    $body = trim($_POST["comments"]);
    $manga_id = (int)($_POST["manga_id"] ?? 0);

    $author_user_id = (int)$_SESSION["user_id"];
    $author_name = null;

    if ($manga_id <= 0 || $body === "") {
        die("Missing manga_id or empty comment.");
    }

    $stmtComment = $conn->prepare(
        "INSERT INTO comments (manga_id, author_user_id, author_name, body)
         VALUES (?, ?, ?, ?)"
    );

    $stmtComment->bind_param("iiss", $manga_id, $author_user_id, $author_name, $body);

    if (!$stmtComment->execute()) {
        die("Comment insert failed: " . $stmtComment->error);
    }

    // Prevent resubmission on refresh
    header("Location: index.php?view_user=" . (int)$view_user);
    exit;
}
// Delete comment (only the owner can delete)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_comment_id"])) {
    if (!is_logged_in()) {
        die("You must be logged in.");
    }

    $comment_id = (int)$_POST["delete_comment_id"];
    $viewer_id  = (int)$_SESSION["user_id"];

    $stmtDel = $conn->prepare("DELETE FROM comments WHERE id = ? AND author_user_id = ?");
    $stmtDel->bind_param("ii", $comment_id, $viewer_id);

    if (!$stmtDel->execute()) {
        die("Delete failed: " . $stmtDel->error);
    }

    header("Location: index.php?view_user=" . (int)$view_user);
    exit;
}


$stmt->execute();
$result = $stmt->get_result();

// Determine if viewer is the owner of the currently selected library
$viewer_id = (is_logged_in() && isset($_SESSION['user_id'])) ? (int)$_SESSION['user_id'] : 0;
$is_owner_view = ($viewer_id > 0 && $viewer_id === $view_user);
?>

<!DOCTYPE html>
<html>
<head>
    <!--- link to css file i changed to v = php echo time since the time changes constantly and therefore css will always be recently uploaded-->
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">

    
</head>
<body>

    <!-- NEW WRAPPER FOR SIDEBAR LAYOUT -->
    <div class="layout">

        <?php include "sidebar.php"; ?>

        <main class="main">
            <div class="card">
            <!--<section class = "container"?>-->
                <!-- new image slider for homepage of manga thru my uploads file for visual niceness -->
                 <div class = "slider-wrapper">
                    <div class = "slider">
                    <div class = "slider-track">
                        <?php
                            $dir = "homepageuploads/"; //uploads folder loop through all file types since uploads only has manga imges
                            $images = glob($dir . "*.{jpg,jpeg,png,webp}", GLOB_BRACE);

                            foreach ($images as $img) {
                                echo '<img src="' . htmlspecialchars($img) . '" class="bg-thumb">';
                            }
                            foreach ($images as $img) {
                                echo '<img src="' . htmlspecialchars($img) . '" class="bg-thumb">';
                            }
                            ?>
                    </div>
                    </div>
                 </div>
            <!--</section>-->
                <div class="main-content">
                    <!-- SEARCH BAR -- made through html-->
                        <!-- USER SEARCH -->
                    <form method="GET" action="index.php" class="search-bar">
                        <input
                            type="text"
                            name="user_search"
                            placeholder="Search users (ex: jiles)"
                            value="<?php echo htmlspecialchars($user_search); ?>"
                        >
                        <button type="submit">Find User</button>
                    </form>

                    <!-- USER SEARCH RESULTS -->
                    <?php if ($user_search !== ""): ?>
                        <div class="user-results">
                            <?php if ($userResults && $userResults->num_rows > 0): ?>
                                <?php while ($u = $userResults->fetch_assoc()): ?>
                                    <a class="user-pill" href="index.php?view_user=<?php echo (int)$u['id']; ?>">
                                        <?php echo htmlspecialchars($u['username']); ?>
                                    </a>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No users found.</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <br>

                    <!-- MANGA SEARCH (inside selected user's library) -->
                    <form method="GET" action="index.php" class="search-bar">
                        <input type="hidden" name="view_user" value="<?php echo (int)$view_user; ?>">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search manga..."
                            value="<?php echo htmlspecialchars($search); ?>"
                        >
                        <button type="submit">Search</button>
                    </form>


                    <br>
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
                                <div class="manga-actions">
                                    <form action="edit_manga.php" method="GET" class="edit-form">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <?php if ($is_owner_view): ?>
                                            <button type="submit" class="edit-btn">
                                            Edit
                                        </button>
                                        <?php endif; ?>
                                    </form>

                                    <form action="delete_manga.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <?php if ($is_owner_view): ?>
                                            <button
                                                type="submit"
                                                class="delete-btn"
                                                onclick="return confirm('Delete this manga?')"
                                            >
                                                Delete
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </div>
                                <p class="manga-description">
                                    <?php echo htmlspecialchars($row['description']); ?>
                                </p>
                                <?php if (is_logged_in()): ?> <!-- only logged-in users can post comments -->
                                <form method="POST">
                                        <input type="hidden" name="manga_id" value="<?php echo (int)$row['id']; ?>">
                                        <textarea name="comments" placeholder="Leave a comment on this users manga..." rows="3" required></textarea>
                                        <button type="submit">Post</button>
                                </form>
                                <?php endif; ?>
                                        <?php
                                            // fetch comments for this manga
                                            $stmtC = $conn->prepare(
                                                "SELECT id, author_user_id, author_name, body, created_at
                                                FROM comments
                                                WHERE manga_id = ?
                                                ORDER BY created_at DESC
                                                "
                                            );
                                            $stmtC->bind_param("i", $row['id']);
                                            $stmtC->execute();
                                            $commentsResult = $stmtC->get_result();
                                            ?>
                                        <div class="comments-section">
                                            <h4>Comments:</h4>
                                            <?php if ($commentsResult->num_rows > 0): ?>
                                                <?php while ($comment = $commentsResult->fetch_assoc()): ?>
                                                    <div class="comment">
                                                        <strong>
                                                            &nbsp <!-- indenting seperating difference from comments and comment (title part)-->
                                                            <?php
                                                            if ($comment['author_user_id']) {
                                                                // Fetch username for registered user
                                                                $stmtU = $conn->prepare("SELECT username FROM users WHERE id = ?");
                                                                $stmtU->bind_param("i", $comment['author_user_id']);
                                                                $stmtU->execute();
                                                                $userRes = $stmtU->get_result();
                                                                if ($userRow = $userRes->fetch_assoc()) {
                                                                    echo htmlspecialchars($userRow['username']);
                                                                } else {
                                                                    echo "Unknown User";
                                                                }
                                                            } else {
                                                                echo htmlspecialchars($comment['author_name'] ?: "Guest");
                                                            } 
                                                            ?>
                                                        </strong>
                                                        <span class="comment-date">
                                                            (<?php echo htmlspecialchars($comment['created_at']); ?>):
                                                        </span>

                                                        <span class="comment-body">
                                                            <?php echo nl2br(htmlspecialchars($comment['body'])); ?>
                                                        </span>

                                                        <?php
                                                        $viewer_id = (is_logged_in() && isset($_SESSION['user_id'])) ? (int)$_SESSION['user_id'] : 0;
                                                        $is_owner_comment = ($viewer_id > 0 && (int)$comment['author_user_id'] === $viewer_id);
                                                        ?>

                                                        <?php if ($is_owner_comment): ?>
                                                            <form method="POST" style="display:inline;"class="trash-form">
                                                                <input type="hidden" name="delete_comment_id" value="<?php echo (int)$comment['id']; ?>">
                                                                <button type="submit" class="trash-btn" title="Delete comment"
                                                                        onclick="return confirm('Delete this comment?')">
                                                                    🗑️
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                        </span>
                                                    </div>
                                                    
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                &nbsp
                                                <body>No comments yet.</body>
                                            <?php endif; ?>
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

            </div>
            <!-- end of card loop div and start of manga database comments section-->
            
        </main>

    </div>
</body>
</html>

<!-- old dynamic background uploaded when clicks cript
<script>
document.getElementById("bgInput").addEventListener("change", () => {
    document.getElementById("bgUploadForm").submit();
});
</script>-->

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
