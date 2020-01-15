<?php

require __DIR__ . '/views/header.php';

if (!userLoggedIn()){
    redirect('/');
};

if (isset($_GET['id'])) {
    $userId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
}
if ($userId === '' || !isset($_GET['id'])) {
    $userId = $_SESSION['user']['id'];
}
$followers = getFollowers($pdo, $userId);

?>

<ul class="userList">
    <?php foreach ($followers as $follower){ ?>
        <li class="searchedProfiles">
            <a href="/profile.php?username=<?php echo $follower['username'] ?>">
                <img class="profileImageSearch" src="<?php echo $follower['avatar_image'] ?>">
                <p><?php echo $follower['username'] ?></p>
            </a>
        </li>
    <?php }; ?>
</ul>
