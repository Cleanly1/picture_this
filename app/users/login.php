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

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = strtolower(trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)));
    $password = $_POST['password'];
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->execute([
        ':email' => $email
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        $_SESSION['errors'][] = 'Seems like you got the wrong password/email';
        redirect('/login.php');
    }
    if (password_verify($password, $user['password']) !== false) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'biography' => $user['biography'],
            'avatar_image' => $user['avatar_image']
        ];
        unset($_SESSION['errors']);
    } else {
        $_SESSION['errors'][] = 'Seems like you got the wrong password/email';
        redirect('/login.php');
    }
}

redirect('/');
