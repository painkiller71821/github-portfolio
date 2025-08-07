<?php
session_start();
include('core/connect.php');

$login = $_POST['login'];      
$password = $_POST['password'];

// Проверяем, что логин и пароль не пустые
if(empty($login) || empty($password)) {
    $_SESSION['error'] = "Заполните все поля";
    header("Location: auth.php");
    exit;
} else {
    // Проверка формата логина (только английские буквы, цифры и символ подчеркивания)
    $loginRegex = '/^[a-zA-Z0-9_]+$/';
    if (!preg_match($loginRegex, $login)) {
        $_SESSION['error'] = "Логин должен содержать только английские буквы, цифры и символ подчеркивания.";
        header("Location: auth.php");
        exit;
    } else {
        // Используем подготовленный запрос для безопасности
        $sql = "SELECT * FROM `users` WHERE login=? AND password=?";
        if ($stmt = $conn->prepare($sql)) {
            // Привязываем параметры
            $stmt->bind_param("ss", $login, $password);
            // Выполняем запрос
            $stmt->execute();
            // Получаем результаты запроса
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                // Успешная авторизация
                $row = $result->fetch_assoc();
                $_SESSION['login'] = $row['login']; // Сохраняем логин в сессии
                $_SESSION['email'] = $row['email']; // Сохраняем email в сессии
                $_SESSION['user']['id'] = $row['id']; // Сохраняем id в сессии          

                // Проверяем, является ли пользователь администратором
                if ($row['role'] == 1) {
                    $_SESSION['admin'] = true;
                }

                header("Location: profile.php");
                exit;
            } else {
                $_SESSION['error'] = "Неверный логин или пароль";
                header("Location: auth.php");
                exit;
            }

            // Закрываем подготовленное выражение
            $stmt->close();
        } else {
            $_SESSION['error'] = "Ошибка выполнения запроса";
            header("Location: auth.php");
            exit;
        }
    }
}
?>
