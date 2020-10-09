<?php

if (!isCurrentUrl('/')) {
    session_start();
}

if (!isCurrentUrl('/') && !$_SESSION['isAuthorized'] && !isset($_GET['login']) && $_GET['login'] != 'yes') {
    header('Location: /');
}

function isCurrentUrl($url)
{
    return $url == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

function getTitle($menu)
{
    foreach ($menu as $item) {
        if (isCurrentUrl($item['path'])) {
            return $item['title'];
        }
    }
}

function trimString($string, $trim = 12): string
{
    if (mb_strlen($string) <= ($trim)) {
        $trimmedString = $string;
    } else {
        $trimmedString = substr($string, 0, $trim) . '...';
    }
    return $trimmedString;
}

function arraySort($array, $sort = SORT_ASC, $key = 'sort'): array
{
    usort($array, function ($a, $b) use ($key, $sort) {
        if ($sort == SORT_DESC) {
            return $b[$key] <=> $a[$key];
        } else {
            return $a[$key] <=> $b[$key];
        }
    });
    return $array;
}

function showMenu($menu, $class = '', $sort = SORT_ASC)
{
    $sortedMenu = arraySort($menu, $sort);
    require $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php';
}

function getGroupsInfo($connection)
{
    $stmt = $connection->prepare("SELECT * FROM `groups` left join group_user on `groups`.`id` = `group_user`.`group_id` where `group_user`.`user_id` = :id");
    $stmt->execute([':id' => $_SESSION['id']]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
    return $result;
}
function getUserInfo($connection)
{
    $stmt = $connection->prepare('select * from users where id = :id');
    $stmt->execute([':id' => $_SESSION['id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $result;
}
