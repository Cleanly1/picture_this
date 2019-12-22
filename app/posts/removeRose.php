<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()){
    redirect('/');
};
if (isset($_GET['rose'])) {

    $postId = filter_var($_GET['rose'], FILTER_SANITIZE_NUMBER_INT);

    $postData = getPost($pdo, $postId);

    $statement = $pdo->prepare('DELETE FROM roses WHERE post_id = :post_id AND user_id = :user_id');
    $statement->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':post_id' => $postId,
    ]);

    updatePost($pdo, $postId, $postData, 0);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }


    redirect('/post.php?id='.$postId);
}

redirect('/');
