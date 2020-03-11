<?php

/*
 * This file is part of Yrgo.
 *
 * (c) Yrgo, högre yrkesutbildning.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/views/header.php';

if (!userLoggedIn()) {
    redirect('/');
}

if (isset($_GET['id'])) {
    $userId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
}
if ($userId === '' || !isset($_GET['id'])) {
    $userId = $_SESSION['user']['id'];
}
$username = getUsername($pdo, $userId);
