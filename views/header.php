<?php
require __DIR__.'/../app/autoload.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/yourTabIcon" type="image/x-icon">
    <title>Picture This</title>
</head>
<body>

    <?php if (isset($_SESSION['errors'])){ ?>
        <div class="errorMessages">
            <?php showErrors(); ?>
        </div>
    <?php }; ?>

    <?php if (isset($_SESSION['success'])){ ?>
        <div class="successMessages">
            <?php showSuccess(); ?>
        </div>
    <?php }; ?>

    <?php require __DIR__ . '/navigation.php' ?>
