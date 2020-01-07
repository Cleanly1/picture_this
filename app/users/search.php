<?php

require __DIR__.'/../autoload.php';

if (!userLoggedIn()){
    redirect('/');
};
if (isset($_GET['search'])) {

    $searchedUsername = filter_var($_GET['search'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :searchedUsername%');
    $users = $statement->execute([
        ':searchedUsername' => $searchedUsername,
    ]);


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $users = json_encode($users);
    header('Content-Type: application/json');
    echo $users;

}
