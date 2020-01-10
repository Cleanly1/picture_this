<?php

require __DIR__ . '/views/header.php';

if (isset($_GET['id'])) {
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    $post = getPostData($pdo, $postId);
}if (isset($_POST['edit'])) {
    $_SESSION['edit'] = $_POST['edit'];
}

?>


<div class="post">
    <?php if (isset($_SESSION['errors'])){ ?>
        <?php showErrors() ?>
    <?php }; ?>

    <div class="postContent">
        <?php if ($_SESSION['user']['id'] === $post['user_id'] && !isset($_POST['edit'])){ ?>
            <div class="dropdownPostSettings">
                <p>Post settings</p>
                <div class="postSettings">
                    <form class="" action="post.php?id=<?php echo $postId ?>" method="post">
                        <button type="submit" name="edit">Edit post</button>
                    </form>
                    <form class="" action="/app/posts/delete.php" method="post">
                        <button type="submit" name="delete" value="<?php echo $postId ?>">Delete post</button>
                    </form>
                </div>
            </div>
        <?php }; ?>
        <img class="postImage" src="<?php echo $post['post_image'] ?>" alt="">
        <form class="roses" method="post">
            <p><?php echo countRoses($pdo, $postId) ?></p>
            <button class="<?php echo !alreadyLiked($pdo, $_SESSION['user']['id'], $postId) ? 'rosebutton' : 'hidden' ?>" type="submit" name="rose" value="<?php echo $postId ?>">
                <img class="rosePost" src="/assets/icons/rose.svg" alt="">
            </button>
            <button class="<?php echo alreadyLiked($pdo, $_SESSION['user']['id'], $postId) ? 'rosebutton' : 'hidden' ?>" type="submit" name="unrose" value="<?php echo $postId ?>">
                <img class="rosePost" src="/assets/icons/unrose.svg" alt="">
            </button>
        </form>
        <?php if (isset($_SESSION['edit']) && $_SESSION['user']['id'] === $post['user_id']){ ?>
            <form class="editPost" action="/app/posts/edit.php" method="post" enctype="multipart/form-data">
                <label for="caption">Description</label>
                <textarea name="caption" rows="8" cols="80" wrap="hard"><?php echo $post['post_text'] ?></textarea>
                <button type="submit" name="postId" value="<?php echo $postId ?>">Update</button>
            </form>
        <?php }else { ?>
            <p><?php echo nl2br($post['post_text']) ?></p>
        <?php } ?>
        <p><?php echo timeAgo(time() - strtotime($post['published'])) == "00 minutes ago" ? 'Just posted' : timeAgo(time() - strtotime($post['published'])) ?></p>
    </div>
</div>






<?php

require __DIR__ . '/views/footer.php';

?>
