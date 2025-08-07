<?php
session_start();
include("core/header.php");

// Проверяем, авторизован ли пользователь как администратор
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {

    // Запрос для получения всех товаров из базы данных
    $sql = "SELECT * FROM catalogue";
    $result = $conn->query($sql);

    echo '
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Все товары</h2>';

    // Проверяем, есть ли товары в базе данных
    if ($result->num_rows > 0) {
        echo '
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Название продукта</th>
                        <th>Изображение</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>';
        
        // Выводим данные о товарах
        while ($row = $result->fetch_assoc()) {
            echo '
            <tr>
                <td>' . htmlspecialchars($row['product_name']) . '</td>
                <td><img src="' . htmlspecialchars($row['image_url']) . '" alt="Изображение товара" style="max-width: 100px;"></td>
                <td>' . htmlspecialchars($row['price']) . '</td>
            </tr>';
        }

        echo '
                </tbody>
            </table>
        </div>';
    } else {
        echo '<p class="text-center">Нет доступных товаров.</p>';
    }

    echo '
                        <div class="text-center mt-3">
                            <a href="admin_panel.php" class="btn btn-dark">Назад к админ панели</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

} else {
    // Если пользователь не администратор, перенаправляем на страницу входа
    header("Location: auth.php");
    exit;
}

include("core/footer.php"); // Включаем футер
?>
