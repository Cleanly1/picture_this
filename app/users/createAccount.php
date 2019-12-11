<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'],$_POST['username'] , $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // $pdo = new PDO($config['database_path']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'] = ['The email address is not a valid email address!'];
        redirect('/createAccount.php');
    }

    if (strlen($username) < 5) {
        $_SESSION['errors'] = ['You have to enter a username that is atleast five characters long'];
        redirect('/createAccount.php');
    }

    if (alreadyExistInDatabase($email, $username, $pdo)) {
        $_SESSION['errors'] = ['It seems that the email or username is already registered.'];
        redirect('/createAccount.php');
    }

    if (alreadyExistInDatabase($email, $username, $pdo)) {
        $_SESSION['errors'] = ['It seems that this username is already in use.'];
        $_SESSION['errors'][] = 'It seems that the email is already registered.';
        redirect('/createAccount.php');
    }

    if (alreadyExistInDatabase($email, $username, $pdo) === false) {
        $statement = $pdo->prepare('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
        $statement->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password
        ]);
        if (isset($_SESSION['errors'])){
            unset($_SESSION['errors']);
        }
    }

}









redirect('/login.php');
