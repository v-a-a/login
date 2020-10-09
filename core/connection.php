<?php
function getConnection()
{
    static $pdo;
    if ($pdo === null) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db_config.php';
        $pdo = new pdo($dsn, $db_user, $db_password);
        return $pdo;
    }
}
/* function getConnection($login = '', $id = '', $query = '')
{
    static $pdo;
    if ($pdo === null) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db_config.php';
        $pdo = new pdo($dsn, $db_user, $db_password);
        $stmt = $pdo->prepare($query);
        if ($login && !$id) {
            $stmt->execute([':email' => $login]);
        } elseif (!$login && $id) {
            $stmt->execute([':id' => $id]);
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $pdo = null;
        if (count($result) > 1) {
            return $result;
        } else {
            return $result[0];
        }
    }
} */