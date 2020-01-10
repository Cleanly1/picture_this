<?php

require __DIR__ . '/views/header.php';

if (isset($_SESSION['user'])) {
    $posts = [];

    $statement = $pdo->prepare('SELECT users.id, users.username, users.avatar_image FROM users LEFT JOIN follows ON users.id = follows.followed_user_id WHERE follows.follows_user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $follows = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($follows as $followed) {
        $followsPosts = getUserPosts($pdo, $followed['id']);
        foreach ($followsPosts as $followsPost) {
            $posts[] = $followsPost;
        }
    }
    $userPosts = getUserPosts($pdo, $_SESSION['user']['id']);
    foreach ($userPosts as $userPost) {
        $posts[] = $userPost;
    }
    $posts = sortsArrays($posts);
    // print_r($posts);
    // die(var_dump(strtotime($posts[1]['published'])));


    ?>

        <div class="feed">
            <?php if (!empty($posts)){ ?>
            <?php foreach ($posts as $post){ ?>


                <div class="feedPosts">
                    <a class="profilePreviewFeed" href="/profile.php?username=<?php echo $post['username'] ?>">
                        <img class="profileImageFeed" src="<?php echo $post['avatar_image'] ?>" alt="">
                        <p class="profileUsernameFeed"><?php echo $post['username'] ?></p>
                    </a>
                    <?php if ($_SESSION['user']['id'] === $post['user_id']){ ?>

                        <div class="dropdownFeedSettings">
                            <p>Post settings</p>
                            <div class="postSettings">
                                <form class="" action="post.php?id=<?php echo $post['id'] ?>" method="post">
                                    <button type="submit" name="edit">Edit post</button>
                                </form>
                                <form class="" action="/app/posts/delete.php" method="post">
                                    <button type="submit" name="delete" value="<?php echo $post['id'] ?>">Delete post</button>
                                </form>
                            </div>
                        </div>
                    <?php }; ?>
                    <img class="feedPostsImage" src="<?php echo $post['post_image'] ?>" alt="">
                    <form class="roses" method="post">
                        <p><?php echo countRoses($pdo, $post['id']) ?></p>
                        <button class="<?php echo !alreadyLiked($pdo, $_SESSION['user']['id'], $post['id']) ? 'rosebutton' : 'hidden' ?>" type="submit" name="rose" value="<?php echo $post['id'] ?>">
                            <img class="rosePost" src="/assets/icons/rose.svg" alt="">
                        </button>
                        <button class="<?php echo alreadyLiked($pdo, $_SESSION['user']['id'], $post['id']) ? 'rosebutton' : 'hidden' ?>" type="submit" name="unrose" value="<?php echo $post['id'] ?>">
                            <img class="rosePost" src="/assets/icons/unrose.svg" alt="">
                        </button>
                    </form>
                    <p><?php echo nl2br($post['post_text']) ?></p>
                    <p><?php echo timeAgo(time() - strtotime($post['published'])) == "00 minutes ago" ? 'Just posted' : timeAgo(time() - strtotime($post['published'])) ?></p>
                </div>

            <?php }; ?>
        <?php }else { ?>
            <h1 class="noPostsText">Your posts and posts from those you follow will show up here</h1>
        <?php }; ?>
        </div>
<?php }; ?>

<?php

require __DIR__ . '/views/footer.php';

?>
