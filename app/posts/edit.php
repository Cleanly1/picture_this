<?php

require __DIR__.'/../autoload.php';


if (!userLoggedIn()){
    redirect('/');
};

if (isset($_POST['description'], $_POST['postId'])) {
    $description = $_POST['description'];
    $postId = $_POST['postId'];

    if (strlen($description) > 255) {

        $_SESSION['errors'][] = 'The description is to long';

    }

    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('UPDATE posts SET post_text = :post_text WHERE id = :id');
        $statement->execute([
            ':post_text' => $description,
            ':id' => $postId
        ]);

        $_SESSION['success'][] = 'Post has been updated';

        redirect('../../post.php?id=' . $postId);
    }
    redirect('../../post.php?id=' . $postId);
}
