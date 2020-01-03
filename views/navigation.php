<?php
isset($_SERVER['QUERY_STRING']) === true ? $queryString = $_SERVER['QUERY_STRING'] : $queryString = '';
?>


<nav class="navbar">
    <ul class="navList">
        <li class="navItem">
            <a href="/" class="navLinks">
                <svg class="hej" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 480">
                    <path fill="<?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? '#000' : '#fff'; ?>" stroke="#000" stroke-width="12" d="M6 454V251.06c0-5.89 2.37-11.52 6.57-15.64L221.51 30.78c11.61-11.37 30.19-11.34 41.76.07l202.84 200c5.05 4.98 7.89 11.77 7.89 18.86V454H315.3v-87.45s3.24-63.16-71.25-61.54c0 0-69.63-1.62-71.25 59.92L171.18 454H6z"/>
                </svg>
            </a>
        </li>
        <?php if (userLoggedIn()){ ?>
            <li class="navItem"><a href="/createPost.php" class="navLinks">New Post</a></li>
            <li class="navItem"><a href="/app/users/logout.php" class="navLinks">Logout</a></li>
            <li class="navItem">
                <a href="/profile.php?username=<?php echo $_SESSION['user']['username'] ?>" class="navLinks">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="30 0 400 400" xml:space="preserve">
                        <path stroke="#000" fill="#fff" stroke-width="10" d="M239.5 91.5s-89-2-98 97c0 0 .5 23.5 13 47.5s37 48.5 85 50.5c0 0 58 0 84.9-49.06 6.98-12.73 11.86-28.76 13.1-48.94 0 0 1-91-98-97z"/>
                        <path stroke="#000" fill="<?php echo $_SERVER['SCRIPT_NAME'] . '?' . $queryString === '/profile.php?username=' . $_SESSION['user']['username'] ? '#000' : '#fff'; ?>" stroke-width="10" d="M154.5 237.5s-74 18-75 110h320s-4-111-75-110c0 0-22 47-85 49 0 0-54 2-85-49z"/>
                        </svg>
                    </a>
                </li>
            <?php }else { ?>
                <li class="navItem"><a href="/login.php" class="navLinks">Login</a></li>
            <?php } ?>

        </ul>
    </nav>
