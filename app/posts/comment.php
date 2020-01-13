<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()){
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
};

if (isset($_POST['comment'], $_GET['id'])) {
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('INSERT INTO comments (post_id, user_id, comment) VALUES(:post_id, :user_id, :comment)');
    $statement->execute([
        ':post_id' => $postId,
        ':user_id' => $_SESSION['user']['id'],
        ':comment' => $comment
    ]);


    redirect('../../post.php?id=' . $postId);
}
