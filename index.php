<?php

require $_SERVER['DOCUMENT_ROOT'] . '/core/authorization.php';
require $_SERVER['DOCUMENT_ROOT'] . '/header.php';

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">
            <h1>Возможности проекта —</h1>
            <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>

        </td>
        <td class="right-collum-index">
            <div class="project-folders-menu">
                <ul class="project-folders-v">
                    <li class="project-folders-v-active"><a href="#">Авторизация</a></li>
                    <li><a href="#">Регистрация</a></li>
                    <li><a href="#">Забыли пароль?</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="index-auth">
                <?php
                if ($displayAuthForm) : ?>
                    <form action="/?login=yes" method="POST">
                        <?php
                        if (isset($_POST['login']) && isset($_SESSION['isAuthorized']) && $_SESSION['isAuthorized'] && $showSuccess) {
                            include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
                        }
                        if (isset($_POST['login']) && !isset($_SESSION['isAuthorized']) && $showError) {
                            include $_SERVER['DOCUMENT_ROOT'] . '/include/error.php';
                        }
                        ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr <?= ((!isset($_SESSION['isAuthorized']) && isset($_COOKIE['id']))) ? 'hidden' : ''; ?>>
                                <td class="iat">
                                    <label for="login_id">Ваш e-mail:</label>
                                    <input id="login_id" size="30" name="login" value="<?= $_POST['login'] ?? '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="iat">
                                    <label for="password_id">Ваш пароль:</label>
                                    <input id="password_id" size="30" name="password" type="password" value="<?= $_POST['password'] ?? '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Войти"></td>
                            </tr>
                        </table>
                    </form>
                <?php endif ?>
            </div>
        </td>
    </tr>
</table>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>