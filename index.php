<?php

require __DIR__ . '/views/header.php';
$posts = array_reverse(getUserPosts($pdo, $_SESSION['user']['id']));
?>

<?php if (isset($_SESSION['user']) && empty($posts)){ ?>

    <h1>Welcome <?php echo $_SESSION['user']['username']?> </h1>

<?php }else { ?>
    <?php foreach ($posts as $post){ ?>

        <div class="feedPosts">
            <?php if ($_SESSION['user']['id'] === $post['user_id']){ ?>

            <div class="dropdownFeedSettings">
                <p>Post settings</p>
                <div class="postSettings">
                    <form class="" action="post.php?id=<?php echo $post['id'] ?>" method="post">
                        <button type="submit" name="edit">Edit post</button>
                    </form>
                    <form class="" action="/app/posts/delete.php" method="post">
                        <button type="submit" name="delete" value="<?php echo $postId ?>">Delete post</button>
                    </form>
                </div>
            </div>
        <?php }; ?>
            <img src="<?php echo $post['post_image'] ?>" alt="">
            <p></p>
            <form class="roses" method="post">
                <p><?php echo countRoses($pdo, $post['id']) ?></p>
                <button class="<?php echo !alreadyLiked($pdo, $_SESSION['user']['id'], $post['id']) ? '' : 'hidden' ?>" type="submit" name="rose" value="<?php echo $post['id'] ?>">Rose this post</button>
                <button class="<?php echo alreadyLiked($pdo, $_SESSION['user']['id'], $post['id']) ? '' : 'hidden' ?>" type="submit" name="unrose" value="<?php echo $post['id'] ?>">Remove rose</button>
            </form>
        </div>

    <?php }; ?>
<?php }; ?>

<?php

require __DIR__ . '/views/footer.php';

?>
