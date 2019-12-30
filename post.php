<?php

require __DIR__ . '/views/header.php';

if (isset($_GET['id'])) {
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    $post = getPostData($pdo, $postId);
}

?>


<div class="post">
    <?php if (isset($_SESSION['errors'])){ ?>
        <?php showErrors() ?>
    <?php }; ?>

    <img src="<?php echo $post['post_image'] ?>" alt="">
    <?php if (isset($_POST['edit']) && $_SESSION['user']['id'] === $post['user_id']){ ?>
        <form class="createPost" action="/app/posts/edit.php" method="post" enctype="multipart/form-data">
            <label for="description">Description</label>
            <textarea name="description" rows="8" cols="80" wrap="hard"><?php echo $post['post_text'] ?></textarea>
            <button type="submit" name="postId" value="<?php echo $postId ?>">Update</button>
        </form>
    <?php }else { ?>
        <p><?php echo nl2br($post['post_text']) ?></p>
    <?php } ?>
    <?php if ($_SESSION['user']['id'] === $post['user_id'] && !isset($_POST['edit'])){ ?>
        <form class="" action="post.php?id=<?php echo $postId ?>" method="post">
            <button type="submit" name="edit">Edit post</button>
        </form>
        <form class="" action="/app/posts/delete.php" method="post">
            <button type="submit" name="delete" value="<?php echo $postId ?>">Delete post</button>
        </form>
    <?php }; ?>

    <?php if (!alreadyLiked($pdo, $_SESSION['user']['id'], $postId)){ ?>

        <form action="/app/posts/rose.php" class="roses">
            <p><?php echo $post['roses'] ?></p>
            <button type="submit" name="rose" value="<?php echo $postId ?>">Rose this post</button>

        <?php }else { ?>

            <form action="/app/posts/removeRose.php" class="roses">
                <p><?php echo $post['roses'] ?></p>
                <button type="submit" name="rose" value="<?php echo $postId ?>">Remove rose</button>

            <?php } ?>
        </form>
    </div>






    <?php

    require __DIR__ . '/views/footer.php';

    ?>
