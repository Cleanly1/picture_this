<?php

/*
 * This file is part of Yrgo.
 *
 * (c) Yrgo, högre yrkesutbildning.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
