<?php
session_start();
include("core/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Рассчитайте общую стоимость заказа
    $cartQuery = mysqli_query($conn, "SELECT SUM(cart.quantity * catalogue.price) AS total_price FROM cart INNER JOIN catalogue ON cart.product_id = catalogue.id WHERE cart.user_id = {$_SESSION['user']['id']}");
    $cartResult = mysqli_fetch_assoc($cartQuery);
    $totalPrice = $cartResult['total_price'];

    // Вставьте данные заказа в таблицу orders
    $insertOrderQuery = "INSERT INTO orders (full_name, phone, address, total_price) VALUES ('$fullName', '$phone', '$address', '$totalPrice')";

    if (mysqli_query($conn, $insertOrderQuery)) {
        // Получите ID последней вставленной записи
        $orderId = mysqli_insert_id($conn);

        // Сохраните данные о товарах из корзины в таблицу order_details
        $cartItemsQuery = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = {$_SESSION['user']['id']}");
        while ($cartItem = mysqli_fetch_assoc($cartItemsQuery)) {
            $productId = $cartItem['product_id'];
            $quantity = $cartItem['quantity'];

            // Получите цену товара из таблицы catalogue
            $productPriceQuery = mysqli_query($conn, "SELECT price FROM catalogue WHERE id = $productId");
            $productPrice = mysqli_fetch_assoc($productPriceQuery)['price'];

            $insertOrderDetailsQuery = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ('$orderId', '$productId', '$quantity', '$productPrice')";
            mysqli_query($conn, $insertOrderDetailsQuery);
        }

        // Очистите корзину пользователя после успешного оформления заказа
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = {$_SESSION['user']['id']}");

        // Перенаправьте пользователя на страницу корзины или страницу подтверждения заказа
        header("Location: cart.php");
        exit();
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }
}
?>