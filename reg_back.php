<?php
session_start();
include('core/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Проверяем совпадение паролей
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Пароли не совпадают.";
            header("Location: auth.php");
            exit;
        }

        // Проверка логина на наличие только английских символов и цифр
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $login)) {
            $_SESSION['error'] = "Логин должен содержать только английские буквы, цифры и символ подчеркивания.";
            header("Location: auth.php");
            exit;
        }

        // Проверка пароля на наличие цифр
        if (!preg_match('/[0-9]/', $password)) {
            $_SESSION['error'] = "Пароль должен содержать хотя бы одну цифру.";
            header("Location: auth.php");
            exit;
        }

        // Проверка уникальности логина
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = "Этот логин уже используется.";
            header("Location: auth.php");
            exit;
        }

        // SQL-запрос для добавления пользователя в базу данных
        $stmt = $conn->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login, $email, $password);

        // Выполняем SQL-запрос
        if ($stmt->execute()) {
            // Перенаправляем пользователя на страницу авторизации
            header("Location: auth.php");
            exit;
        } else {
            $_SESSION['error'] = "Ошибка при регистрации пользователя: " . $stmt->error;
            header("Location: auth.php");
            exit;
        }

        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['error'] = "Не удалось получить все необходимые данные из формы.";
        header("Location: auth.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Форма не была отправлена методом POST.";
    header("Location: auth.php");
    exit;
}
?>
