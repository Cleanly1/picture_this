<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'],$_POST['username'] , $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement-> execute([
        ':email' => $email,
    ]);

    $emailAlreadyExist = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $statement-> execute([
        ':username' => $username,
    ]);

    $usernameAlreadyExist = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($emailAlreadyExist === [] && $usernameAlreadyExist === []) {
        $statement = $pdo->prepare('INSERT INTO users (name, email, password) VALUES(:username, :email, :password)');
        $statement->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password
        ]);
        if (isset($_SESSION['errors'])){
            unset($_SESSION['errors']);
        }
    }
    if ($emailAlreadyExist !== [] && $usernameAlreadyExist === []) {
        $_SESSION['errors'] = ['It seems that the email is already registered.'];
        redirect('/createAccount.php');
    }
    if ($usernameAlreadyExist !== [] && $emailAlreadyExist === []) {
        $_SESSION['errors'] = ['It seems that this username is already in use.'];
        redirect('/createAccount.php');
    }
    if ($usernameAlreadyExist !== [] && $emailAlreadyExist !== []) {
        $_SESSION['errors'] = ['It seems that this username is already in use.'];
        $_SESSION['errors'][] = 'It seems that the email is already registered.';
        redirect('/createAccount.php');
    }

}









redirect('/login.php');
