<?php

require __DIR__ . '/views/header.php';
if (!userLoggedIn()){
    redirect('/');
};

$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
// if ($username == "") {
//     redirect('/');
// }
if ($_SESSION['user']['username'] !== $username && $username != "") {
    $userData = getUserData($pdo, $username);
} else {
    $userData = $_SESSION['user'];
};

isset($_SERVER['QUERY_STRING']) ? $username = explode("=" , $_SERVER['QUERY_STRING'])[1] : $username = $userData['username'];

?>
<div class="profile">
    <div class="profileName">
        <h1><?php echo $userData['username'] ?></h1>
        <?php if ($_SESSION['user']['username'] === $username){ ?>
            <a href="/settings.php" class="navLinks" >
                <svg class="cog" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                    <g stroke="#000" stroke-miterlimit="10" stroke-width="14">
                        <path fill="#000" d="m219.5 396.5s5-31 19-46l-38-74s-6-13 0-20c0 0 28-46 75-76 0 0 12-4 20 0l73 38s9-9 49-20l25-80s2-11 17-14c0 0 49-8 97-1 0 0 15 4 19 14l27 80s39 13 48 20l73-37s8-4 22 0c0 0 56 39 74 76 0 0 4 13 0 19l-38 73s19 33 19 48l81 27s14 4 15 21c0 0 6 44 0 92 0 0-5 19-15 20l-81 26s-4 25-19 47l38 75s4 10 0 19c0 0-16 36-72 73 0 0-7 6-23 3l-74-39s-15 14-48 20l-26 81s-4 12-18 14c0 0-54 11-100 0 0 0-12-6-15-14s-25-79-25-79-33-8-49-22l-72 38s-12 6-22 0c0 0-29-9-75-75 0 0-5-9 1-18l37-74s-16-23-19-49l-82-26s-12-6-14-18c0 0-8-42 0-94 0 0 0-12 15-20z"/>
                        <path fill="#66ccff" d="m315.5 490.25s0-183.76 195-195.75c0 0 181-3.99 195 195.75 0 0-1 183.76-196 194.75 0 0-182-1-194-194.75z"/>
                    </g>
                </svg>
            </a>
        <?php }; ?>
    </div>
    <!-- Profile info with avatar image and biography -->
    <div class="profileInfo">
        <img src="<?php echo $userData['avatar_image'] ?>" alt="">
        <div class="profileBio">
            <?php if ($userData['biography'] === "" && $username === $_SESSION['user']['username']){  ?>
                <p>You can change your bio in the settings</p>
            <?php }else { ?>
                <p><?php echo nl2br($userData['biography']) ?></p>
            <?php } ?>
        </div>
    </div>
    <!-- Follow button -->
    <div class="followFunction">
        <?php if ($userData['username'] !== $_SESSION['user']['username']){ ?>
            <form class="followForm" action="app/users/<?php echo !checkIfFollowed($pdo, $userData['id'], $_SESSION['user']['id']) ? "follow.php" : "unfollow.php" ?>" method="post">
                <button class="<?php echo !checkIfFollowed($pdo, $userData['id'], $_SESSION['user']['id']) ? 'isNotFollowed' : 'hidden' ?>" type="submit" value="<?php echo $userData['username'] ?>" name="follow">Follow</button>
                <button class="<?php echo !checkIfFollowed($pdo, $userData['id'], $_SESSION['user']['id']) ? 'hidden' : 'isFollowed' ?>" type="submit" value="<?php echo $userData['username'] ?>" name="unfollow">Unfollow</button>
            </form>
        <?php }; ?>
        <a class="<?php echo $userData['username'] === $_SESSION['user']['username'] ? 'followers usersFollowers' : 'followers' ?>" href="/followers.php?id=<?php echo $userData['id'] ?>">
            <h4>Followers<br><?php echo countFollowers($pdo, $userData['id']) ?></h4>
        </a>
        <a class="followers usersFollowers" href="/following.php?id=<?php echo $userData['id'] ?>">
            <h4>Following<br><?php echo countFollowing($pdo, $userData['id']) ?></h4></a>
    </div>
    <!-- The selected users posts -->
    <div class="posts">
        <?php $posts = getUserPosts($pdo, $userData['id']); ?>
        <?php if (empty($posts) && $username === $_SESSION['user']['username']){ ?>
            <div class="noPost">
                <h2>You have no posts, maybe consider adding some</h2>
                <p>Great idea? Just press here<a href="/createPost.php" class="navLinks">New Post</a></p>

            </div>

        <?php } else { ?>

            <?php foreach ($posts as $post){ ?>
                <a class="previewPosts" href="/post.php?id=<?php echo $post['id'] ?>">
                    <img src="<?php echo $post['post_image'] ?>" alt="">
                </a>
            <?php }; ?>

        <?php } ?>
    </div>

</div>
<?php

require __DIR__ . '/views/footer.php';

?>
