<?php 

require __DIR__ . '/views/header.php';

 ?>

 <?php if (isset($_SESSION['user'])){ ?>
   
   <h1>Welcome <?php echo $_SESSION['user']['username']?> </h1>
   
   
 <?php }; ?>


 <?php 

 require __DIR__ . '/views/footer.php';

  ?>