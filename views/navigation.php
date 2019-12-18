


<nav class="navbarMobileBox">
    <ul class="navList">
        <li class="navItem"><a href="/" class="navLinks">Home</a></li>
        <?php if (userLoggedIn()){ ?>
            <li class="navItem"><a href="/createPost.php" class="navLinks">New Post</a></li>
            <li class="navItem"><a href="/app/users/logout.php" class="navLinks">Logout</a></li>
            <li class="navItem"><a href="/profile.php" class="navLinks">Profile</a></li>
        <?php }else { ?>
            <li class="navItem"><a href="/login.php" class="navLinks">Login</a></li>
        <?php } ?>

    </ul>
</nav>
