<nav class="navbar">
    <div class="container">
        <a href="/" class="navbar-item navbar-brand">
            Helpdesk
        </a>
        <div class="navbar-item navbar-separator"></div>
        <a href="/" class="navbar-item">
            Home
        </a>

        <?php if(isset($_COOKIE['user_id'])): ?>
        <a href="logout.php" class="navbar-item">
            Logout
        </a>
        <?php endif; ?>
    </div>
</nav>