<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()) {
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
}

if (isset($_POST['delete'])) {
    $postId = filter_var($_POST['delete'], FILTER_SANITIZE_NUMBER_INT);
    $post = getPostData($pdo, $postId);

    if ($post["user_id"] !== $_SESSION['user']['id']) {
        $_SESSION['errors'][] = 'You can\'t delete other users posts';
    }

    if (!isset($_SESSION['errors'])) {

        unlink('../..' . $post['post_image']);

        $statement = $pdo->prepare('DELETE FROM posts WHERE id = :id AND user_id = :user_id');
        $statement->execute([
            ':id' => $postId,
            ':user_id' => $_SESSION['user']['id']
        ]);

        $statement = $pdo->prepare('DELETE FROM roses WHERE post_id = :post_id');
        $statement->execute([
            ':post_id' => $postId,
        ]);
        redirect('../../profile.php?username=' . $_SESSION['user']['username']);
    }
    redirect('../../post.php?id=' . $postId);
}
