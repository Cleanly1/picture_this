<?php
isset($_SERVER['QUERY_STRING']) === true ? $queryString = $_SERVER['QUERY_STRING'] : $queryString = '';
?>


<nav class="navbar">
    <ul class="navList">
        <li class="navItem">
            <a href="/" class="navLinks">
                <svg class="home" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 480">
                    <path fill="<?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? '#000' : '#fff'; ?>" stroke="#000" stroke-width="12" d="M6 454V251.06c0-5.89 2.37-11.52 6.57-15.64L221.51 30.78c11.61-11.37 30.19-11.34 41.76.07l202.84 200c5.05 4.98 7.89 11.77 7.89 18.86V454H315.3v-87.45s3.24-63.16-71.25-61.54c0 0-69.63-1.62-71.25 59.92L171.18 454H6z"/>
                    </svg>
                </a>
            </li>
            <?php if (userLoggedIn()){ ?>
                <li class="navItem"><a href="/createPost.php" class="navLinks">
                    <svg class="newPost" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 460 460">
                      <path fill="<?php echo $_SERVER['SCRIPT_NAME'] === '/createPost.php' ? '#000' : '#fff'; ?>" d="M344.75 431H116.02c-46.1 0-83.47-37.37-83.47-83.47V109.47c0-46.1 37.37-83.47 83.47-83.47h228.72c46.1 0 83.47 37.37 83.47 83.47v238.06c.01 46.1-37.36 83.47-83.46 83.47z" fill="#fff" stroke="#000" stroke-width="14" stroke-linecap="round" stroke-miterlimit="10"/>
                      <path fill="<?php echo $_SERVER['SCRIPT_NAME'] === '/createPost.php' ? '#fff' : '#000'; ?>" d="M245.28 117.8V200c0 7.78 6.31 14.09 14.09 14.09h77.98c7.78 0 14.09 6.31 14.09 14.09s-6.31 14.09-14.09 14.09h-77.98c-7.78 0-14.09 6.31-14.09 14.09v83.14c0 7.78-6.31 14.09-14.09 14.09h-1.88c-7.78 0-14.09-6.31-14.09-14.09v-83.14c0-7.78-6.31-14.09-14.09-14.09h-77.98c-7.78 0-14.09-6.31-14.09-14.09s6.31-14.09 14.09-14.09h77.98c7.78 0 14.09-6.31 14.09-14.09v-82.2c0-7.78 6.31-14.09 14.09-14.09h1.88c7.78 0 14.09 6.31 14.09 14.09z"/>
                    </svg>

                </a></li>
                <li class="navItem"><a href="/search.php" class="navLinks">
                    <svg class="search" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 460 460" xml:space="preserve">
                      <path stroke="#000" fill="<?php echo $_SERVER['SCRIPT_NAME'] === '/search.php' ? '#000' : '#fff'; ?>" stroke-width="10" d="M52.64 240.99c-16.21-34.58-19.47-73.97-9.42-110.81 12.4-45.46 47.59-103.52 146.02-109.1 0 0 101.9-6.67 141.96 99.85 12.48 33.17 13.78 69.68 2.53 103.28-11.88 35.48-39.3 76.5-101.88 94.32-38.06 10.84-78.94 7.76-114.21-10.2-24.03-12.23-48.8-32.79-65-67.34z"/>
                      <path stroke="#000" fill="#fff" stroke-width="10" d="M97.26 231.61c-17.58-28.56-20.59-63.65-9.54-95.32 11.17-32.04 37.83-69.43 101.34-71.33 0 0 80.86-.7 103.61 78.25 6.27 21.75 6.11 44.93-1.14 66.37-8.28 24.47-27.2 54.46-70.41 67.15-25.15 7.38-52.12 6.41-76.17-4-16.48-7.13-34.4-19.54-47.69-41.12zM273.03 300.39l110.75 130.79s14.66 15.17 31.29 3.25c0 0 14.48-11.77 4.79-25.59L306.12 272.15s-7.3 9.14-33.09 28.24z"/>
                    </svg>

                </a></li>
                <li class="navItem"><a href="/app/users/logout.php" class="navLinks">Logout</a></li>
                <li class="navItem">
                    <a href="/profile.php?username=<?php echo $_SESSION['user']['username'] ?>" class="navLinks">
                        <svg class="profileLink" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="30 0 400 400" xml:space="preserve">
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
