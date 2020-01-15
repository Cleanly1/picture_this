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
$follows = getFollowing($pdo, $userId);

?>

<ul class="userList">
<?php foreach ($follows as $following){ ?>
    <li class="searchedProfiles"><a href="/profile.php?username=<?php echo $following['username'] ?>">
    <img class="profileImageSearch" src="<?php echo $following['avatar_image'] ?>"><p><?php echo $following['username'] ?></p>
    </a></li>
<?php }; ?>
</ul>
