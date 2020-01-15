<?php

require __DIR__ . '/followHeader.php';

$users = getFollowing($pdo, $userId);

require __DIR__ . '/followList.php';

?>
