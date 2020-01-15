<?php

require __DIR__ . '/views/header.php';

if (isset($_GET['id'])) {
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    $post = getPostData($pdo, $postId);
}if (isset($_POST['edit'])) {
    $_SESSION['edit'] = filter_var($_POST['edit'], FILTER_SANITIZE_STRING);
}

$comments = getPostComments($pdo, $postId);

?>


<div class="post">

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
        <div class="postsImage">
            <img class="postImage" src="<?php echo $post['post_image'] ?>" alt="">
        </div>
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
            <p class="caption"><?php echo nl2br($post['post_text']) ?></p>
        <?php } ?>

        <div class="comments">
            <?php foreach ($comments as $comment){ ?>
                <a class="profileCommentLink" href="/profile.php?username=<?php echo $comment['username'] ?>">
                    <img class="profileImageFeed" src="<?php echo $comment['avatar_image'] ?>" alt="">
                    <p><?php echo $comment['username'] ?></p>
                </a>
                <p class="commentText"><?php echo nl2br($comment['comment']) ?></p>
            <?php }; ?>
        </div>
        <form class="commentForm" action="/app/posts/comment.php" method="post">
            <input type="hidden" name="id" value="<?php echo $postId ?>">
            <textarea name="comment" rows="8" cols="80"></textarea>
            <button type="submit" name="button">Comment</button>
        </form>
        <p class="timeAgo"><?php echo timeAgo(time() - strtotime($post['published'])) == "00 minutes ago" ? 'Just posted' : timeAgo(time() - strtotime($post['published'])) ?></p>
    </div>
</div>






<?php

require __DIR__ . '/views/footer.php';

?>
