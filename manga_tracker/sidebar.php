<!-- sidebar.php -->
<aside class="sidebar">
	<div class="sidebar-header">
		<img src="nonmangaimages/manga_bite_logo.png" alt="Manga Logo" width="230" height ="70">
		<div class="sidebar-subtitle">Library and tools</div>
	</div>

	<nav class="sidebar-nav">
		<div class="sidebar-group">
			<div class="sidebar-group-title">Main</div>
            <?php if (is_logged_in()): ?>
				<a class="sidebar-link"a href="index.php?view_user=0"> Home</a>
				<a class="sidebar-link"a href="index.php?view_user=<?php echo (int)$_SESSION['user_id']; ?>&my_library= <?php echo (int)$_SESSION['user_id']; ?> "> My Library</a>
				<a class="sidebar-link-add" href="add_manga.php">+ Add Manga</a>
			<div class="sidebar-group-title">Account</div>
				<a class="sidebar-link" href="settings.php">Settings</a>
				<a class="sidebar-link" href="logout.php">Logout</a>
            <?php else: ?>
				<a class="sidebar-link"a href="index.php?view_user=0; ?>"> Home</a>
                <a class="sidebar-link"a href="login.php">Login</a>
            <?php endif; ?>
		</div>

	</nav>
    

	<div class="sidebar-footer">
		<div class="sidebar-footnote">Version 0.2 JS <3 </div>
	</div>
</aside>


