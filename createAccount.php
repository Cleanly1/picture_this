<?php

require __DIR__ . '/views/header.php';

 ?>

 <form class="makeAccount" action="/app/users/createAccount.php" method="post">
     <h1>Register an account</h1>
   <label for="email">Email</label>
   <input type="text" name="email" value="" placeholder="example@example.se" required>
   <label for="username">Username</label>
   <input type="username" name="username" value="" placeholder="theBeastMaster" >
   <label for="password">Password</label>
   <input type="password" name="password" value="" required>
   <button type="submit" name="button">Create Account</button>
 </form>






 <?php

 require __DIR__ . '/views/footer.php';

  ?>
