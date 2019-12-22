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
        <div class="roses">
            <p><?php echo $post['roses'] ?></p>
            <button type="button" name="button">Rose this post</button>
        </div>
        <div class="rice">
            <p><?php echo $post['rice'] ?></p>
            <button type="button" name="button">Rice this post</button>
        </div>
</div>






 <?php

 require __DIR__ . '/views/footer.php';

  ?>
