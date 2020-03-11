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
};

if (isset($_POST['id'])) {
    $commentId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $statement->execute([
        ':id' => $commentId,
    ]);

    $comment = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$comment) {
        $_SESSION['errors'][] = 'Something unexpected happend';
    }

    if ($comment['user_id'] != $_SESSION['user']['id']) {
        $_SESSION['errors'][] = 'You can\'t delete other users comments';
    }

    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('DELETE FROM comments WHERE id = :id AND user_id = :user_id');
        $statement->execute([
            ':id' => $commentId,
            ':user_id' => $_SESSION['user']['id']
        ]);
        $_SESSION['success'][] = 'Your comment has been deleted';
        redirect('../../post.php?id=' . $comment['post_id']);
    }
    redirect('/');
}
