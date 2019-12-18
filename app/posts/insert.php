<?php

require __DIR__.'/../autoload.php';


if (!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_FILES['postImage'])) {
    die(var_dump($_FILES));
}
