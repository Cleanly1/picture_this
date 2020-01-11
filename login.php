<?php

require __DIR__ . '/views/header.php';

 ?>
 <div class="loginPage">
 <form class="loginForm" action="app/users/login.php" method="post">
   <label for="email">Email</label>
   <input type="email" name="email" placeholder="example@example.se" required>
   <label for="password">Password</label>
   <input type="password" name="password" required>
   <button type="submit" name="login">Login</button>
 </form>
 <a href="/createAccount.php">Create account</a>
</div>

 <?php

 require __DIR__ . '/views/footer.php';

  ?>
