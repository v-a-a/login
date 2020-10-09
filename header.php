<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/main_menu.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/app.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/styles.css" rel="stylesheet">
    <title>Project - ведение списков</title>
</head>

<body>

    <div class="header">
        <div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix">
        <?php showMenu($menu, 'main-menu', SORT_ASC) ?>
        <?php
        if (isset($_SESSION['isAuthorized']) && $_SESSION['isAuthorized']) {

        ?><div class="sign-btn"><a class="sign-link" href='/?login=no'>Выйти</a></div>
        <?php } else {

        ?><div class="sign-btn"><a class="sign-link" href='/?login=yes'>Авторизоваться</a></div>
        <?php } ?>
    </div>