<?php
session_start();
include("core/connect.php");

if(isset($_SESSION['user']['id']) && isset($_GET['id'])) {
    $userId = $_SESSION['user']['id'];
    $cartItemId = $_GET['id'];

    // Удаляем товар из базы данных
    $deleteQuery = mysqli_query($conn, "DELETE FROM cart WHERE id = $cartItemId AND user_id = $userId");

    if ($deleteQuery) {
        echo "Товар успешно удален из корзины";
    } else {
        echo "Ошибка удаления товара из корзины: " . mysqli_error($conn);
    }
} else {
    echo "Ошибка: пользователь не авторизован или не передан идентификатор товара";
}
?>
