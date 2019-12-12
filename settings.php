<?php

require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}


 ?>

 <?php if (isset($_SESSION['errors'])){ ?>
  <?php foreach ($_SESSION['errors'] as $error){ ?>
    <p><?php echo $error ?></p>
  <?php }; ?>
  <?php unset($_SESSION['errors']) ?>
 <?php }; ?>
<form class="changePassword" action="/app/users/update.php" method="post">
    <h1>Change Password</h1>
    <label for="oldPassword">Old Password</label>
    <input type="password" name="oldPassword" value="" required>
    <label for="newPassword">New Password</label>
    <input type="password" name="newPassword" value="" required>
    <label for="repeatNewPassword">Repeat New Password</label>
    <input type="password" name="repeatNewPassword" value="" required>
    <button type="submit" name="button">Change Password</button>
</form>
