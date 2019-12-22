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
    /**
    * Checks if email or username exist in the database
    * @param  string $searchedEmail    The searched email
    * @param  string $searchedUsername The searched username
    * @param  object $pdo              [description]
    * @return bool                     [description]
    */
    function alreadyExistInDatabase(string $searchedEmail, string $searchedUsername, object $pdo):array {
        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :searchedEmail OR username = :searchedUsername');
        $statement-> execute([
            ':searchedEmail' => $searchedEmail,
            ':searchedUsername' => $searchedUsername
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}


if (!function_exists('getUserData')) {
    /**
     * Gets the specified users data
     * @param  object $pdo [database]
     * @return array       [user data]
     */
    function getUserData(object $pdo, int $id):array {
        $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute([
            ':id' => $id
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }




}

if (!function_exists('getUserPosts')) {
    /**
     * Gets an users posts
     * @param  object $pdo [description]
     * @return array       [description]
     */
    function getUserPosts(object $pdo, int $id):array {
        $statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :id');
        $statement->execute([
            ':id' => $id
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}


if (!function_exists('getPost')) {
    function getPost(object $pdo, int $id):array {
        $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
        $statement->execute([
            ':id' => $id
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
if (!function_exists('updatePost')) {
    function updatePost(object $pdo, int $id, array $postData, int $updateOption):void {
        $roses = $postData['roses'];
        $statement = $pdo->prepare('UPDATE posts SET roses = :roses WHERE id = :id');
        if ($updateOption === 0) {
            $roses--;
        }
        if ($updateOption === 1) {
            $roses++;
        }
            $statement->execute([
                ':roses' => $roses,
                ':id' => $postId
            ]);

    }
}

function alreadyLiked(object $pdo, $userId, $postId) {
    $statement = $pdo->prepare('SELECT * FROM roses WHERE post_id = :post_id AND user_id = :user_id');
    $statement->execute([
        ':post_id' => $postId,
        ':user_id' => $userId
    ]);

    $roseData = $statement->fetch(PDO::FETCH_ASSOC);
    return $roseData;
}
