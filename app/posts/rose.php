<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()){
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
};
if (isset($_POST['rose'])) {

    $postId = filter_var($_POST['rose'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('INSERT INTO roses (user_id, post_id) VALUES(:user_id, :post_id)');
    $statement->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':post_id' => $postId,
    ]);


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    updateRose($pdo, $postId, countRoses($pdo, $postId));

    $roses = countRoses($pdo, $postId);
    $roses = json_encode($roses);
    header('Content-Type: application/json');
    echo $roses;

}

// redirect('/');
