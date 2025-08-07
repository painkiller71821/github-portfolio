<?php
session_start();
include("core/connect.php");

header('Content-Type: application/json');

$response = [];

// Проверяем, был ли передан идентификатор товара для добавления в корзину
if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    
    if (isset($_SESSION['user']['id'])) {
        $userId = $_SESSION['user']['id'];
        
        // Проверяем, существует ли продукт в таблице products
        $productCheckQuery = "SELECT * FROM catalogue WHERE id = $productId";
        $productCheckResult = mysqli_query($conn, $productCheckQuery);
        
        if (mysqli_num_rows($productCheckResult) > 0) {
            // Проверяем, есть ли уже такой товар в корзине пользователя
            $checkQuery = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $productId";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // Если товар уже есть в корзине, увеличиваем количество
                $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $userId AND product_id = $productId";
                if (mysqli_query($conn, $updateQuery)) {
                    $response = ['status' => 'success', 'message' => 'Количество товара в корзине увеличено'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Ошибка при обновлении количества товара'];
                }
            } else {
                // Если товара нет в корзине, добавляем его
                $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, 1)";
                if (mysqli_query($conn, $insertQuery)) {
                    $response = ['status' => 'success', 'message' => 'Товар успешно добавлен в корзину'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Ошибка при добавлении товара в корзину'];
                }
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Товар не найден'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Пользователь не авторизован'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Идентификатор товара не указан'];
}

echo json_encode($response);
?>