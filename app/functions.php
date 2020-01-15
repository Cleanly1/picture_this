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
    * @param  string $username [username]
    * @return array       [user data]
    */
    function getUserData(object $pdo, string $username) {
        $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $statement->execute([
            ':username' => $username
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}

if (!function_exists('getUsername')) {
    /**
    * Gets the specified users username based on userId
    * @param  object $pdo [database]
    * @param  int $userId [user id]
    * @return array       [user data]
    */
    function getUsername(object $pdo, int $userId):string {
        $statement = $pdo->prepare('SELECT username FROM users WHERE id = :userId');
        $statement->execute([
            ':userId' => $userId
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user['username'];
    }

}

if (!function_exists('getUserPosts')) {
    /**
    * Gets an users posts
    * @param  object $pdo [database]
    * @param  int $id      The selected user
    * @return array       [the users posts]
    */
    function getUserPosts(object $pdo, int $id):array {
        $statement = $pdo->prepare('SELECT posts.id, posts.user_id, posts.post_image, posts.post_text, posts.published, users.id as user_id, users.username, users.avatar_image FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE user_id = :id ORDER BY published DESC');
        $statement->execute([
            ':id' => $id
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}


if (!function_exists('getPostData')) {
    /**
    * Gets the selected post from the database
    * @param  object $pdo [Database]
    * @param  int    $id  [id of the post]
    * @return array       [post data]
    */
    function getPostData(object $pdo, int $id):array {
        $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
        $statement->execute([
            ':id' => $id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);

    }
}
if (!function_exists('updateRose')) {
    /**
    * Updates the roses of a post based on the update option
    * @param object $pdo          [database]
    * @param int    $postId       [The rosed post]
    * @param array  $postData     [The post data]
    */
    function updateRose(object $pdo, int $postId, int $roses):void {

        $statement = $pdo->prepare('UPDATE posts SET roses = :roses WHERE id = :id');
        $statement->execute([
            ':roses' => $roses,
            ':id' => $postId
        ]);

    }
}

if (!function_exists('alreadyLiked')) {
    /**
    * Checks if a post id already liked
    * @param  object $pdo    [description]
    * @param  int    $userId [description]
    * @param  int    $postId [description]
    * @return [mixed]         [returns false or an array]
    */
    function alreadyLiked(object $pdo, int $userId, int $postId):bool {
        $statement = $pdo->prepare('SELECT * FROM roses WHERE post_id = :post_id AND user_id = :user_id');
        $statement->execute([
            ':post_id' => $postId,
            ':user_id' => $userId
        ]);
        $check = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$check) {
            return false;
        } else {
            return true;
        }

    }
}

if (!function_exists('showErrors')) {
    /**
    * Shows the errors for the user
    */
    function showErrors():void {
        foreach ($_SESSION['errors'] as $error){
            echo $error;
        };
        unset($_SESSION['errors']);
    }
}

if (!function_exists('showSuccess')) {
    /**
    * Shows the errors for the user
    */
    function showSuccess():void {
        foreach ($_SESSION['success'] as $success){
            echo $success;
        };
        unset($_SESSION['success']);
    }
}

if (!function_exists('countRoses')) {
    /**
    * Counts number of roses on a post
    * @param object   $pdo
    * @param int      $postId
    * @return int
    */
    function countRoses(object $pdo, int $postId):int {
        $statement = $pdo->prepare('SELECT * FROM roses WHERE post_id = :post_id');
        $statement->execute([
            ':post_id' => $postId,
        ]);
        $roses = $statement->fetchAll(PDO::FETCH_ASSOC);

        return count($roses);
    }
}

if (!function_exists('sortsArrays')) {
    /**
    * Sorts the articles array by published date
    * @param  array $array [description]
    * @return array        [description]
    */
    function sortsArrays(array $array):array {
        usort($array, function($arrayItem1, $arrayItem2) {
            return (time() - strtotime($arrayItem1['published'])) <=> (time() - strtotime($arrayItem2['published']));
        });

        return $array;
    }
}
if (!function_exists('timeAgo')) {
    /**
    * Gets the time from when the its published to now
    * @param int    $timeAgo
    * @return string
    */
    function timeAgo(int $timeAgo):string {
        if ($timeAgo < (60*60)) {
            return date('i', $timeAgo)." minutes ago";
        } elseif ($timeAgo > 60*60 && $timeAgo < 60*60*24) {
            return date('H', $timeAgo)." hours ago";
        } elseif ($timeAgo > 60*60*24 && $timeAgo < 60*60*24*7) {
            return date('j', $timeAgo)." days ago";
        } else {
            return date('j', $timeAgo)." days ago";
        }
    }
}

if (!function_exists('checkIfFollowed')) {
    /**
    * Checks if a user already follows another user
    * @param  object $pdo    [description]
    * @param  int    $followedUser [description]
    * @param  int    $userId
    * @return mixed           [Returns an array or false]
    */
    function checkIfFollowed(object $pdo, int $followedUser, int $userId) {

        $statement = $pdo->prepare('SELECT * FROM follows WHERE followed_user_id = :followedUser AND follows_user_id = :user_id');
        $statement->execute([
            ':followedUser' => $followedUser,
            ':user_id' => $userId
        ]);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        return $statement->fetch(PDO::FETCH_ASSOC);

    }
}


if (!function_exists('getFollowers')) {
    /**
    * Gets all the users that follows a user
    * @param  object $pdo    [description]
    * @param  int    $userId [description]
    * @return array            [description]
    */
    function getFollowers(object $pdo, int $userId):array {

        $statement = $pdo->prepare('SELECT * FROM follows LEFT JOIN users ON follows.follows_user_id = users.id WHERE followed_user_id = :user_id');
        $statement->execute([
            ':user_id' => $userId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('getFollowing')) {
    /**
    * Gets all the users a person is following
    * @param  object $pdo    [description]
    * @param  int    $userId [description]
    * @return array            [description]
    */
    function getFollowing(object $pdo, int $userId):array {

        $statement = $pdo->prepare('SELECT * FROM follows LEFT JOIN users ON follows.followed_user_id = users.id WHERE follows_user_id = :user_id');
        $statement->execute([
            ':user_id' => $userId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}

if (!function_exists('countFollowers')) {
    /**
    * Counts all the users that is following a user
    * @param  object $pdo    [description]
    * @param  int    $userId [description]
    * @return int            [description]
    */
    function countFollowers(object $pdo, int $userId):int {
        $statement = $pdo->prepare('SELECT * FROM follows WHERE followed_user_id = :user_id');
        $statement->execute([
            ':user_id' => $userId,
        ]);
        $followers = $statement->fetchAll(PDO::FETCH_ASSOC);

        return count($followers);
    }
}
if (!function_exists('countFollowing')) {
    /**
    * Counts all the users that a user follows
    * @param  object $pdo    [description]
    * @param  int    $userId [description]
    * @return int            [description]
    */
    function countFollowing(object $pdo, int $userId):int {
        $statement = $pdo->prepare('SELECT * FROM follows WHERE follows_user_id = :user_id');
        $statement->execute([
            ':user_id' => $userId,
        ]);
        $followers = $statement->fetchAll(PDO::FETCH_ASSOC);

        return count($followers);
    }
}

if (!function_exists('getPostComments')) {
    /**
    * Gets all the comments from a post
    * @param  object $pdo    [description]
    * @param  int    $postId [description]
    * @return array         [description]
    */
    function getPostComments(object $pdo, int $postId):array {
        $statement = $pdo->prepare('SELECT * FROM comments LEFT JOIN users ON users.id = comments.user_id WHERE post_id = :post_id');
        $statement->execute([
            ':post_id' => $postId,
        ]);


        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
