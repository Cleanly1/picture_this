<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()){
    redirect('/');
};
if (isset($_GET['rose'])) {

    $postId = filter_var($_GET['rose'], FILTER_SANITIZE_NUMBER_INT);

    $postData = getPostData($pdo, $postId);

    $statement = $pdo->prepare('INSERT INTO roses (user_id, post_id) VALUES(:user_id, :post_id)');
    $statement->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':post_id' => $postId,
    ]);

    updateRose($pdo, $postId, $postData, 1);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }


    redirect('/post.php?id=' . $postId);
}

redirect('/');
