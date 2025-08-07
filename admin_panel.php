<?php
session_start();
include("core/header.php");

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    echo '
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Административная панель</h2>
                        <div class="text-center mb-3">
                            <a href="view_users.php" class="btn btn-dark btn-block">Посмотреть всех пользователей</a>
                        </div>
                        
                        <div class="text-center mb-3">
                            <a href="view_comments.php" class="btn btn-dark btn-block">Просмотреть все комменты</a>
                        </div>
                        <div class="text-center mb-3">
                            <a href="view_products.php" class="btn btn-dark btn-block">Просмотреть все товары</a>
                        </div>
                        <div class="text-center">
                            <a href="logout_admin.php" class="btn btn-secondary btn-block">Выйти из админки</a>
                        </div>
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
<script>
    $(document).ready(function() {
        // Активация модального окна при клике на кнопку "Добавить товар"
        $('#addProductModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Кнопка, вызвавшая модальное окно
            // Добавить сюда код для дополнительных действий при открытии модального окна, если необходимо
        });
    });
</script>

