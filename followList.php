<div class="profileName">
    <a class="backButton" href="/profile.php?username=<?php echo $username ?>">Back</a>
    <h1><?php echo $username ?></h1>
</div>
<ul class="userList">
    <?php foreach ($users as $user){ ?>
        <li class="searchedProfiles">
            <a href="/profile.php?username=<?php echo $user['username'] ?>">
                <img class="profileImageSearch" src="<?php echo $user['avatar_image'] ?>">
                <p><?php echo $user['username'] ?></p>
            </a>
        </li>
    <?php }; ?>
</ul>
