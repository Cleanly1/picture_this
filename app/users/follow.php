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

if (!userLoggedIn()) {
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
}

if (isset($_POST['follow'])) {
    $followedUser = filter_var($_POST['follow'], FILTER_SANITIZE_STRING);

    $followedUser = getUserData($pdo, $followedUser);

    $check = checkIfFollowed($pdo, intval($followedUser['id']), intval($_SESSION['user']['id']));

    if ($check !== false) {
        $_SESSION['errors'][] = 'You already follows this user';
    }

    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('INSERT INTO follows (followed_user_id, follows_user_id) VALUES(:followed_user_id, :user_id)');
        $statement->execute([
            ':followed_user_id' => $followedUser['id'],
            ':user_id'          => $_SESSION['user']['id'],
        ]);
        redirect('../../profile.php?username='.$followedUser['username']);
    } else {
        redirect('../../profile.php?username='.$followedUser['username']);
    }

    // if (!$check) {
    //     $followed = json_encode([
    //             'response' => false
    //     ]);
    // }else {
    //     $followed = json_encode([
    //             'response' => true
    //     ]);
    // }
    //
    // header('Content-Type: application/json');
    // echo $followed;
}
