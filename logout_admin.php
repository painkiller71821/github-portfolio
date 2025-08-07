<?php
session_start();

// Удаляем все переменные сессии
$_SESSION = array();

// Удаляем сессию
session_destroy();

// Перенаправляем на страницу авторизации
header("Location: auth.php");
exit;
?>
