<?php

require __DIR__ . '/views/header.php';

?>

<?php if (isset($_SESSION['user'])) { ?>
    <?php $posts = array_reverse(getUserPosts($pdo, $_SESSION['user']['id'])); ?>
    <?php foreach ($posts as $post){ ?>
        <div class="feed">
            <div class="feedPosts">
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
                <img src="<?php echo $post['post_image'] ?>" alt="">
                <form class="roses" method="post">
                    <p><?php echo countRoses($pdo, $post['id']) ?></p>
                    <button class="<?php echo !alreadyLiked($pdo, $_SESSION['user']['id'], $post['id']) ? '' : 'hidden' ?>" type="submit" name="rose" value="<?php echo $post['id'] ?>">Rose this post</button>
                    <button class="<?php echo alreadyLiked($pdo, $_SESSION['user']['id'], $post['id']) ? '' : 'hidden' ?>" type="submit" name="unrose" value="<?php echo $post['id'] ?>">Remove rose</button>
                </form>
                <p><?php echo nl2br($post['post_text']) ?></p>
            </div>
        </div>

    <?php }; ?>
<?php }; ?>

<?php

require __DIR__ . '/views/footer.php';

?>
