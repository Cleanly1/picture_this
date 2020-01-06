<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()){
    redirect('/');
};
if (isset($_GET['rose'])) {

    $postId = filter_var($_GET['rose'], FILTER_SANITIZE_NUMBER_INT);


    // $statement = $pdo->prepare('SELECT * FROM roses WHERE post_id = :post_id AND user_id = :user_id');
    // $statement->execute([
    //     ':post_id' => $postId,
    //     ':user_id' => $_SESSION['user']['id']
    // ]);
    // $check_for_like = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare('INSERT INTO roses (user_id, post_id) VALUES(:user_id, :post_id)');
    $statement->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':post_id' => $postId,
    ]);


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    updateRose($pdo, $postId, countRoses($pdo, $postId), 1);

    $roses = countRoses($pdo, $postId);
    $roses = json_encode($roses);
    header('Content-Type: application/json');
    echo $roses;

}

// redirect('/');
