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

if (isset($_POST['caption'], $_POST['postId'])) {
    $caption = $_POST['caption'];
    $postId = $_POST['postId'];

    preg_match_all("/(\n)/", $caption, $matches);
    $totalLines = count($matches[0]) + 1;

    // die(var_dump($totalLines));
    if ($totalLines > 6 || strlen($caption)-$totalLines > 255) {
        $_SESSION['errors'][] = 'Your text is tooooo long';
    }
    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('UPDATE posts SET post_text = :post_text WHERE id = :id');
        $statement->execute([
            ':post_text' => $caption,
            ':id' => $postId
        ]);

        $_SESSION['success'][] = 'Post has been updated';
        unset($_SESSION['edit']);
        redirect('../../post.php?id=' . $postId);
    }
    redirect('../../post.php?id=' . $postId);
}
