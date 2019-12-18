<?php

require __DIR__ . '/views/header.php';

 ?>


 <form class="createPost" action="/app/posts/insert.php" method="post" enctype="multipart/form-data">
     <label for="postImage">Choose an image to upload</label>
     <input type="file" accept="image/jpg,image/png" name="postImage" id="postImage" required>
     <label for="description">Description</label>
     <textarea name="description" rows="8" cols="80" wrap="hard"></textarea>
     <button type="submit">Upload</button>
 </form>




 <?php

 require __DIR__ . '/views/footer.php';

  ?>
