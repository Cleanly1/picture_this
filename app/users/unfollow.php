<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (!userLoggedIn()) {
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
}


if (isset($_POST['unfollow'])) {

    $followedUser = filter_var($_POST['unfollow'], FILTER_SANITIZE_STRING);

    $followedUser = getUserData($pdo, $followedUser);

    $check = checkIfFollowed($pdo, intval($followedUser['id']), intval($_SESSION['user']['id']));

    // die(var_dump($check));

    if ($check === false) {
        $_SESSION['errors'][] = 'Something went wrong...';
    }


    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('DELETE FROM follows WHERE followed_user_id = :followed_user_id AND follows_user_id = :user_id');
        $statement->execute([
            ':followed_user_id' => $followedUser['id'],
            ':user_id' => $_SESSION['user']['id'],
        ]);
        redirect('../../profile.php?username=' . $followedUser['username']);
    }else {
        redirect('../../profile.php?username=' . $followedUser['username']);
    }


    // if (!isset($_SESSION['errors'])) {
    //     $followed = json_encode([
    //             'response' => true
    //     ]);
    // }else {
    //     $followed = json_encode([
    //             'response' => false
    //     ]);
    // }
    //
    // header('Content-Type: application/json');
    // echo $followed;


}
