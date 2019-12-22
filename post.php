<?php

require __DIR__ . '/views/header.php';

if (isset($_GET['id'])) {
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post = getPost($pdo, $postId);
}

 ?>


<div class="post">
    <img src="<?php echo $post['post_image'] ?>" alt="">
</div>






 <?php

 require __DIR__ . '/views/footer.php';

  ?>
