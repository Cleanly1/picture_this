<?php

declare(strict_types=1);


if (!function_exists('redirect')) {
    /**
    * Redirect the user to given path.
    *
    * @param string $path
    *
    * @return void
    */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

if (!function_exists('userLoggedIn')) {
    /**
    * Checks if the user is logged in or not
    * @return bool
    */
    function userLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else{
            return false;
        }
    }

}


if (!function_exists('alreadyExistInDatabase')) {

    function alreadyExistInDatabase($searchedEmail, $searchedUsername, $pdo){
        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :searchedEmail OR username = :searchedUsername');
        $statement-> execute([
            ':searchedEmail' => $searchedEmail,
            ':searchedUsername' => $searchedUsername
        ]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($result === []) {
            return false;
        } else{
            return true;
        }
    }
}
