<?php
session_start();
include("core/header.php");

if(isset($_SESSION['login']) && isset($_SESSION['email'])) {
    // Выводим логин и email пользователя в блоке по центру
    echo '
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Личный кабинет</h2>
                        <p><strong>Логин:</strong> ' . $_SESSION['login'] . '</p>
                        <p><strong>Email:</strong> ' . $_SESSION['email'] . '</p>';
                        
                        // Показываем кнопку для администратора
                        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
                            echo '<div class="text-center mb-3">
                                      <a href="admin_panel.php" class="btn btn-dark btn-block">Административная панель</a>
                                  </div>';
                        }

                        echo '<form action="logout.php" method="post">
                            <button type="submit" class="btn btn-secondary btn-block">Выйти</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>';
} else {
    header("Location: auth.php");
    exit;
}
?>
