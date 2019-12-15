<?php

require __DIR__ . '/views/header.php';

?>

<div class="profileName">
    <h1><?php echo $_SESSION['user']['username'] ?></h1>
    <a href="/settings.php" class="navLinks" >Settings</a>
</div>
<div class="profileInfo">
    <img src="<?php echo $_SESSION['user']['avatar'] ?>" alt="">
    <h4><?php echo $_SESSION['user']['username'] ?></h4>
</div>
<div class="profileBio">
    <?php if ($_SESSION['user']['bio'] === ""){ ?>
        <p>You can change your bio in settings</p>
    <?php }else { ?>
        <p><?php echo nl2br($_SESSION['user']['bio']) ?></p>
    <?php } ?>
</div>


<?php

require __DIR__ . '/views/footer.php';

?>
