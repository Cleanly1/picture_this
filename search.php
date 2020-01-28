<?php

require __DIR__ . '/views/header.php';

if (!userLoggedIn()) {
    redirect('/');
}

?>

<form class="searchUsers" method="get">
    <input type="text" name="" value="" placeholder="Search for a user...">
    <button class="searchButton" type="submit" name="button">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 460 460" xml:space="preserve">
            <path stroke="#000" fill="#fff" stroke-width="10" d="M52.64 240.99c-16.21-34.58-19.47-73.97-9.42-110.81 12.4-45.46 47.59-103.52 146.02-109.1 0 0 101.9-6.67 141.96 99.85 12.48 33.17 13.78 69.68 2.53 103.28-11.88 35.48-39.3 76.5-101.88 94.32-38.06 10.84-78.94 7.76-114.21-10.2-24.03-12.23-48.8-32.79-65-67.34z" />
            <path stroke="#000" fill="#000" stroke-width="10" d="M97.26 231.61c-17.58-28.56-20.59-63.65-9.54-95.32 11.17-32.04 37.83-69.43 101.34-71.33 0 0 80.86-.7 103.61 78.25 6.27 21.75 6.11 44.93-1.14 66.37-8.28 24.47-27.2 54.46-70.41 67.15-25.15 7.38-52.12 6.41-76.17-4-16.48-7.13-34.4-19.54-47.69-41.12zM273.03 300.39l110.75 130.79s14.66 15.17 31.29 3.25c0 0 14.48-11.77 4.79-25.59L306.12 272.15s-7.3 9.14-33.09 28.24z" />
        </svg>
    </button>
</form>

<form class="postForm" method="post" action="/app/users/searchtest.php">
    <input class="searchPost" type="text" name="searchPost" value="" placeholder="Search for a post..." autocomplete="off">
    <button class="searchButton2" type="submit" name="">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 460 460" xml:space="preserve">
            <path stroke="#000" fill="#fff" stroke-width="10" d="M52.64 240.99c-16.21-34.58-19.47-73.97-9.42-110.81 12.4-45.46 47.59-103.52 146.02-109.1 0 0 101.9-6.67 141.96 99.85 12.48 33.17 13.78 69.68 2.53 103.28-11.88 35.48-39.3 76.5-101.88 94.32-38.06 10.84-78.94 7.76-114.21-10.2-24.03-12.23-48.8-32.79-65-67.34z" />
            <path stroke="#000" fill="#000" stroke-width="10" d="M97.26 231.61c-17.58-28.56-20.59-63.65-9.54-95.32 11.17-32.04 37.83-69.43 101.34-71.33 0 0 80.86-.7 103.61 78.25 6.27 21.75 6.11 44.93-1.14 66.37-8.28 24.47-27.2 54.46-70.41 67.15-25.15 7.38-52.12 6.41-76.17-4-16.48-7.13-34.4-19.54-47.69-41.12zM273.03 300.39l110.75 130.79s14.66 15.17 31.29 3.25c0 0 14.48-11.77 4.79-25.59L306.12 272.15s-7.3 9.14-33.09 28.24z" />
        </svg>
    </button>
</form>


<ul class="userList">
</ul>

<!-- Container that holds searched posts -->
<ul class="postItems">
</ul>

<script src="/assets/scripts/searchposts.js"></script>

<?php require __DIR__ . '/views/footer.php'; ?>
