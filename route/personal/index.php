<?php

require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/core/connection.php';

$connection = getConnection();

$user = getUserInfo($connection);
$groups = getGroupsInfo($connection);


?>
<h1><?= getTitle($menu); ?></h1><br>
<h2>Основные сведения</h2>
<ul style="margin-left: 50px;">
    <li>
        <h3>Пользователь: <?= $user['name']; ?></h3>
    </li>
    <li>
        <h3>Email: <?= $user['email']; ?></h3>
    </li>
    <li>
        <h3>Телефон: <?= $user['phone']; ?></h3>
    </li>
</ul><br>
<h2>Членство в группах</h2>
<ul style="margin-left: 50px;">
    <?php
    foreach ($groups as $key => $group) : ?>
        <li>
            <h3><?= $group['name']; ?> - <?= $group['description']; ?></h3>
        </li>
    <?php endforeach; ?>
</ul><br>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';

?>