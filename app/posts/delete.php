<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()) {
    redirect('/');
}

if (isset($_POST['delete'])) {
    $postId = filter_var($_POST['delete'], FILTER_SANITIZE_NUMBER_INT);
    $post = getPostData($pdo, $postId);

    $statement = $pdo->prepare('DELETE FROM posts WHERE id = :id AND user_id = :user_id');
    $statement->execute([
        ':id' => $postId,
        ':user_id' => $_SESSION['user']['id']
    ]);

    redirect('../../profile.php?id=' . $_SESSION['user']['id']);
}
