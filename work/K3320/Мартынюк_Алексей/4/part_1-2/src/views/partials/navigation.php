<div id="navbar-wrapper">
    <p>Logo</p>
    <nav>
        <a href="/search.php" class="<?php if ($_SERVER['REQUEST_URI'] == '/search.php') echo 'active'; ?>">Search</a>
        <?php if (is_auth()): ?>
            <a href="/cart.php" class="<?php if ($_SERVER['REQUEST_URI'] == '/cart.php') echo 'active'; ?>">Cart</a>
            <a href="/profile.php" class="<?php if ($_SERVER['REQUEST_URI'] == '/profile.php') echo 'active'; ?>">Profile</a>
            <a href="/logout.php" class="<?php if ($_SERVER['REQUEST_URI'] == '/logout.php') echo 'active'; ?>">Logout</a>
        <?php else: ?>
            <a href="/signin.php" class="<?php if ($_SERVER['REQUEST_URI'] == '/signin.php') echo 'active'; ?>">Login</a>
        <?php endif; ?>
    </nav>
</div>