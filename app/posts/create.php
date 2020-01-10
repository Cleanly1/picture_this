<?php

require __DIR__.'/../autoload.php';


if (!userLoggedIn()){
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
};

if (isset($_FILES['postImage'])) {
    $postImage = $_FILES['postImage'];
    $caption = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    if ($postImage['type'] != 'image/jpg' && $postImage['type'] != 'image/jpeg' && $postImage['size'] !== 0) {

      $_SESSION['errors'][] = 'The image file type is not allowed.';

    }

    if ($postImage['size'] > 2097152 || $postImage['size'] === 0) {

        $_SESSION['errors'][] = 'The uploaded file exceeded the file size limit.';

    }

    preg_match_all("/(\n)(\r)/", $caption, $matches);
    $totalLines = count($matches[0]) + 1;

    if ($totalLines > 6 || strlen($caption)-$totalLines > 255) {
        $_SESSION['errors'][] = 'Your text is tooooo long';
    }

    if (!isset($_SESSION['errors'])) {

        $imagePath = '/uploads/' . uniqid() . '.jpg';
        $publishedDate = date('Y/m/d H:i:s');

        move_uploaded_file($postImage['tmp_name'], '../..' . $imagePath);
        $statement = $pdo->prepare('INSERT INTO posts (user_id, post_image, post_text, roses, published) VALUES(:user_id, :post_image, :post_text, 0, :published)');
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
        $statement->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':post_image' => $imagePath,
            ':post_text' => $caption,
            ':published' => $publishedDate
        ]);
        redirect('/');
    }
    redirect('/createPost.php');


}
