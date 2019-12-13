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

 <form class="changeBio" action="/app/users/update.php" method="post">
     <h1>Update Bio</h1>
     <label for="changeBio">Bio</label>
     <textarea name="bio" rows="5" cols="32" wrap="hard"><?php echo $_SESSION['user']['bio'] ?></textarea>
     <button type="submit" name="button">Update Bio</button>
 </form>

<form class="chooseAvatar" action="index.html" method="post">

</form>



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


<?php

require __DIR__ . '/views/footer.php';

 ?>
