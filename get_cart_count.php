<?php
session_start();
include("core/connect.php");

if(isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];

    // Запрос к базе данных для подсчета количества элементов в корзине пользователя
    $cartCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = $userId");

    if ($cartCountQuery) {
        $cartCountResult = mysqli_fetch_assoc($cartCountQuery);
        $cartCount = $cartCountResult['cart_count'];
        echo $cartCount; // Отправляем количество элементов в корзине обратно клиенту
    } else {
        echo "Ошибка при запросе количества элементов в корзине";
    }
} else {
    echo "Ошибка: пользователь не авторизован";
}
?>
