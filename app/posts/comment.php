<?php

/*
 * This file is part of Yrgo.
 *
 * (c) Yrgo, högre yrkesutbildning.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../autoload.php';

if (!userLoggedIn()) {
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
}

if (isset($_POST['comment'], $_POST['id'])) {
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $postId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $publishedDate = date('Y/m/d H:i:s');

    if (strlen($comment) > 255) {
        $_SESSION['errors'][] = 'Your comment is tooooo long';
    }
    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('INSERT INTO comments (post_id, user_id, comment, published) VALUES(:post_id, :user_id, :comment, :published)');
        $statement->execute([
            ':post_id'   => $postId,
            ':user_id'   => $_SESSION['user']['id'],
            ':comment'   => $comment,
            ':published' => $publishedDate,
        ]);
    }
    redirect('../../post.php?id='.$postId);
}
