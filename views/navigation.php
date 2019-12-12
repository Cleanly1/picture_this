


<nav class="navbarMobileBox">
  <h1 class="title"><?php echo $config['title'] ?></h1>
  <ul class="navList">
    <li class="navItem"><a href="/" class="navLinks">Home</a></li>
    <li class="navItem"><a href="#" class="navLinks">About</a></li>
    <?php if (userLoggedIn()){ ?>
      <li class="navItem"><a href="/app/users/logout.php" class="navLinks">Logout</a></li>
      <li class="navItem"><a href="/profile.php" class="navLinks">Profile</a></li>
    <?php }else { ?>
    <li class="navItem"><a href="/login.php" class="navLinks">Login</a></li>
  <?php } ?>
  <?php if ($_SERVER['PHP_SELF'] === "/profile.php" && userLoggedIn()){ ?>
          <li class="navItem" style="align-self:flex-end"><a href="/settings.php" class="navLinks" >Settings</a></li>
      <?php } ?>
  </ul>
</nav>