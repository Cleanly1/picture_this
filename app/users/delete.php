<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Delete account

if (isset($_POST)) {

    $statement = $pdo->prepare("SELECT * FROM users where id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    $statement = $pdo->prepare("DELETE FROM roses WHERE user_id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    $statement = $pdo->prepare("DELETE FROM posts WHERE user_id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    $statement = $pdo->prepare("DELETE FROM comments WHERE user_id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    session_destroy();

    redirect("/");
}
