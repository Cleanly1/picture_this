<?php

require __DIR__.'/views/header.php';

if (!userLoggedIn()) {
    redirect('/');
}

?>

<form class="createPost" action="/app/posts/create.php" method="post" enctype="multipart/form-data">
    <h1>Create a new post</h1>
    <label for="postImage">Choose an image to upload</label>
    <input type="file" accept="image/jpg, image/jpeg" name="postImage" id="postImage" required>
    <label for="description">Description</label>
    <textarea name="description" rows="8" cols="80" wrap="hard"></textarea>
    <button type="submit">Upload</button>
</form>




<?php

require __DIR__.'/views/footer.php';

?>
