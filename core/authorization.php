<?php

session_start();

$displayAuthForm = false;
if (isset($_GET['login'])) {
    if ($_GET['login'] == 'yes') {
        $displayAuthForm = true;
    } elseif ($_GET['login'] == 'no') {
        $displayAuthForm = true;
        setcookie('id', '');
        unset($_COOKIE['id']);
        unset($_SESSION['id']);
        unset($_SESSION['isAuthorized']);
    } else {
        $displayAuthForm = false;
    }
}

function checkUserByLogin($connection)
{
    $stmt = $connection->prepare('select * from users where email = :email');
    $stmt->execute([':email' => $_POST['login']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function checkUserByID($connection)
{
    $stmt = $connection->prepare('select * from users where id = :id');
    $stmt->execute([':id' => $_COOKIE['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

if (isset($_POST['password'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/core/connection.php';
    $connection = getConnection();

    if (!isset($_POST['login']) && !isset($_SESSION['id']) && isset($_COOKIE['id'])) {
        $user = checkUserByID($connection);
    } elseif (isset($_POST['login'])) {
        $user = checkUserByLogin($connection);
    }

    if ($user && password_verify($_POST['password'], $user['password'])) {
        setcookie('id', $user['id'], time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['id'] = $user['id'];
        $_SESSION['isAuthorized'] = true;
        $showSuccess = true;
    } else {
        setcookie('id', '');
        unset($_COOKIE['id']);
        unset($_SESSION['isAuthorized']);
        unset($_SESSION['id']);
        unset($_SESSION['user']);
        $showError = true;
    }
}

if (isset($_COOKIE['id']) && isset($_SESSION['isAuthorized']) && $_SESSION['isAuthorized'] === true) {
    setcookie('id', $_COOKIE['id'], time() + 60 * 60 * 24 * 30, '/');
}
