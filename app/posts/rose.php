<?php

require __DIR__.'/../autoload.php';

$postId = filter_var($_GET['rose'], FILTER_SANITIZE_NUMBER_INT);

$statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
$statement->execute([
    ':id' => $postId
]);

$postData = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare('INSERT INTO roses (user_id, post_id) VALUES(:user_id, :post_id)');
$statement->execute([
    ':user_id' => $_SESSION['user']['id'],
    ':post_id' => $postId,
]);

$statement = $pdo->prepare('UPDATE posts SET roses = :roses WHERE id = :id');
$statement->execute([
    ':roses' => ++$postData['roses'],
    ':id' => $postId
]);

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}


redirect('/post.php?id='.$postId);
