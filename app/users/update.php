<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_POST['oldPassword'], $_POST['newPassword'],$_POST['repeatNewPassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $userData = $statement->fetch(PDO::FETCH_ASSOC);
    if (!password_verify($oldPassword, $userData['password'])) {
        $_SESSION['errors'][] = 'You entered the wrong password';
    }
    if ($_POST['newPassword'] !== $_POST['repeatNewPassword']) {
        $_SESSION['errors'][] = 'Your new password didn\'t match';
    }
    if (password_verify($_POST['newPassword'], $userData['password'])) {
        $_SESSION['errors'][] = 'You can\'t pick the same password.';
    }
    if (empty($_SESSION['errors'])) {
        $statement = $pdo->prepare('UPDATE users SET password = :newPassword WHERE id = :id');
        $statement->execute([
            ':newPassword' => password_hash($_POST['newPassword'], PASSWORD_BCRYPT),
            ':id' => $_SESSION['user']['id']
        ]);

    }

    redirect('/settings.php');
}

if (isset($_POST['bio'])) {
    $updatedBio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);


    preg_match_all("/(\n)/", $updatedBio, $matches);
    $totalLines = count($matches[0]) + 1;
    if ($totalLines > 6) {
        $_SESSION['errors'][] = 'Your text is tooooo long';
    }
    if (empty($_SESSION['errors'])) {
        $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');
        $statement->execute([
            ':biography' => $updatedBio,
            ':id' => $_SESSION['user']['id']
        ]);
        $_SESSION['user']['bio'] = $updatedBio;
        // if (!$hej) {
        //     die(var_dump($pdo->errorInfo()));
        // }
    }
    redirect('/settings.php');
}

redirect('/');
