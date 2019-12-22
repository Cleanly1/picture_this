<?php

require __DIR__.'/../autoload.php';


if (!userLoggedIn()){
    redirect('/');
};

if (isset($_FILES['postImage'])) {
    $postImage = $_FILES['postImage'];
    $caption = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    if ($postImage['size'] > 2097152) {
      $_SESSION['errors'][] = 'The uploaded file exceeded the file size limit.';
    }
    if ($postImage['type'] != 'image/jpg' && $postImage['type'] != 'image/jpeg') {
      $_SESSION['errors'][] = 'The image file type is not allowed.';
    }
    if (strlen($caption) > 255) {
        $_SESSION['errors'][] = 'The description is to long';
    }
    if (!isset($_SESSION['errors'])) {
        $imagePath = '/uploads/' . uniqid() . '.jpg';
        $publishedDate = date('d m Y H:i:s');

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
