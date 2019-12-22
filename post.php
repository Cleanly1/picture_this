<?php

require __DIR__ . '/views/header.php';

if (isset($_GET['id'])) {
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post = getPost($pdo, $postId);
}

?>


<div class="post">
    <img src="<?php echo $post['post_image'] ?>" alt="">
    <p><?php echo $post['post_text'] ?></p>
    <?php if (alreadyLiked($pdo, $_SESSION['user']['id'], $postId) !== false){ ?>
        <form action="/app/posts/removeRose.php" class="roses">
            <p><?php echo $post['roses'] ?></p>
            <button type="submit" name="rose" value="<?php echo $postId ?>">Remove rose</button>
        <?php }else { ?>
            <form action="/app/posts/rose.php" class="roses">
                <p><?php echo $post['roses'] ?></p>
                <button type="submit" name="rose" value="<?php echo $postId ?>">Rose this post</button>
            <?php } ?>
        </form>
    </div>






    <?php

    require __DIR__ . '/views/footer.php';

    ?>
