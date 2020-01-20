<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

// Gets posts from database based on a search query
if (isset($_POST["searchPost"])) {

    $searchedPost = trim(filter_var($_POST["searchPost"], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare("SELECT users.id AS user_id, users.username, posts.id, posts.post_image FROM posts INNER JOIN users ON posts.user_id = users.id WHERE post_text LIKE :searchQuery");

    $statement->execute([
        ":searchQuery" => "%" . $searchedPost . "%"
    ]);

    $postItems = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($postItems);
    exit;
}
