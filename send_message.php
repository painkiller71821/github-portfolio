<?php
session_start();
include("core/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, были ли отправлены данные формы
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Получаем данные из формы
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Подготавливаем SQL-запрос для вставки комментария в таблицу comment
        $stmt = $conn->prepare("INSERT INTO reviews (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Выполняем SQL-запрос
        if ($stmt->execute()) {
            // Если запрос выполнен успешно, перенаправляем пользователя на страницу с контактами
            header("Location: reviews.php");
            exit;
        } else {
            // Если произошла ошибка при выполнении запроса, выводим сообщение об ошибке
            echo "Ошибка при отправке сообщения";
        }

        // Закрываем подготовленное выражение и соединение с базой данных
        $stmt->close();
        $conn->close();
    } else {
        // Если данные формы не были отправлены, выводим сообщение об ошибке
        echo "Ошибка: данные формы не были отправлены";
    }
} else {
    // Если был отправлен GET-запрос, перенаправляем пользователя на главную страницу
    header("Location: index.php");
    exit;
}
?>
