<?php

require __DIR__ . '/views/header.php';

?>

<div class="profileName">
    <h1><?php echo $_SESSION['user']['username'] ?></h1>
</div>

<div class="profileBio">
    <img src="<?php echo $_SESSION['user']['username'] ?>" alt="">
    <h4><?php echo $_SESSION['user']['username'] ?></h4>
    <p><?php echo nl2br($_SESSION['user']['bio']) ?></p>
</div>


<?php

require __DIR__ . '/views/footer.php';

?>
