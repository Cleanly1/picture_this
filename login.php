<?php 

require __DIR__ . '/views/header.php';

 ?>
 
 <form class="loginForm" action="app/users/login.php" method="post">
   <label for="email">Email</label>
   <input type="text" name="email" placeholder="example@example.se">
   <label for="password">Password</label>
   <input type="text" name="password">
   <button type="submit" name="login">Login</button>
 </form>
 <a href="/createAccount.php">Create account</a>
 
 <?php 

 require __DIR__ . '/views/footer.php';

  ?>