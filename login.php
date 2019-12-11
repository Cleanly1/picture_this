<?php 

require __DIR__ . '/views/header.php';

 ?>
 <?php if (isset($_SESSION['errors'])){ ?>
   <?php foreach ($_SESSION['errors'] as $error){ ?>
     <p><?php echo $error ?></p>
   <?php }; ?>
   <?php unset($_SESSION['errors']) ?>
 <?php }; ?>
 
 <form class="loginForm" action="app/users/login.php" method="post">
   <label for="email">Email</label>
   <input type="email" name="email" placeholder="example@example.se" required>
   <label for="password">Password</label>
   <input type="password" name="password" required>
   <button type="submit" name="login">Login</button>
 </form>
 <a href="/createAccount.php">Create account</a>
 
 <?php 

 require __DIR__ . '/views/footer.php';

  ?>