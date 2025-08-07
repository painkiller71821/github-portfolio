<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <!-- Подключаем Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Добавляем немного пользовательских стилей */
        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 15px;
        }
        .product-image {
            max-width: 100px;
            margin-right: 15px;
        }
        .product-info {
            flex-grow: 1;
        }
    </style>
</head>
<body class="bg-secondary text-white">

<?php
session_start();
include("core/header.php");
include("core/connect.php");

// Проверяем, был ли передан параметр id в запросе
if (isset($_GET['id'])) {
    $cartItemId = $_GET['id'];
    
    // Удаляем товар из базы данных
    $deleteQuery = mysqli_query($conn, "DELETE FROM cart WHERE id = $cartItemId");

    // Проверяем успешность выполнения запроса
    if ($deleteQuery) {
        // Если товар успешно удален из базы данных, перенаправляем пользователя обратно на страницу корзины
        header("Location: cart.php");
        exit();
    } else {
        // Если произошла ошибка при удалении, выводим сообщение об ошибке
        echo "Ошибка удаления товара из корзины: " . mysqli_error($conn);
    }
}

$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
if($userId) {
    // Запрос к базе данных для выборки товаров из корзины
    $cartQuery = mysqli_query($conn, "SELECT cart.*, catalogue.product_name, catalogue.price, catalogue.image_url FROM cart INNER JOIN catalogue ON cart.product_id = catalogue.id WHERE cart.user_id = $userId");
if ($cartQuery && mysqli_num_rows($cartQuery) > 0) {
?>
<div class="container">
    <div class="cart-container">
        <?php
        $totalPrice = 0;
        while ($cartItem = mysqli_fetch_assoc($cartQuery)) {
            $totalPrice += $cartItem['quantity'] * $cartItem['price'];
        ?>
            <div class="cart-item row align-items-center" data-cart-item-id="<?php echo $cartItem['id']; ?>">
                <div class="col-md-2">
                    <img src="<?php echo $cartItem['image_url']; ?>" alt="Product Image" class="product-image img-fluid">
                </div>
                <div class="col-md-6 product-info">
                    <p class="product-name"><?php echo $cartItem['product_name']; ?></p>
                    <p class="product-price"><?php echo $cartItem['price']; ?> р.</p>
                </div>
                <div class="col-md-4 quantity-controls d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <button class="btn btn-dark quantity-button minus" data-cart-item-id="<?php echo $cartItem['id']; ?>">-</button>
                        </div>
                        <p class="item-quantity mx-3" data-cart-item-id="<?php echo $cartItem['id']; ?>"><?php echo $cartItem['quantity']; ?></p>
                        <div class="ml-3">
                            <button class="btn btn-dark quantity-button plus" data-cart-item-id="<?php echo $cartItem['id']; ?>">+</button>
                        </div>
                    </div>
                    <button class="btn btn-danger remove-button" data-cart-item-id="<?php echo $cartItem['id']; ?>">X</button>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="total-price mt-4">Общая сумма: <?php echo $totalPrice; ?> р.</div>
    <div class="btn_div mt-3">
        <button class="btn btn-dark button_basket" data-toggle="modal" data-target="#orderModal">Заказать</button>
    </div>
</div>

<!-- Модальное окно для оформления заказа -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-secondary text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Оформление заказа</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="orderForm" action="send_order.php" method="post">
          <div class="form-group">
            <label for="fullName">ФИО:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
          </div>
          <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" class="form-control" id="phone" name="phone" pattern="\d*" required>
            <small class="form-text text-muted">Пожалуйста, введите только цифры.</small>
          </div>
          <div class="form-group">
            <label for="address">Адрес:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-dark btn-block">Отправить заказ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="empty-cart-message" style="display:none;">
    <p class="no-products">Ваша корзина пуста.</p>
</div>

<!-- Подключаем Bootstrap JS и jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Обработчики событий для кнопок "Плюс", "Минус" и "Удалить"
        var minusButtons = document.querySelectorAll('.quantity-button.minus');
        var plusButtons = document.querySelectorAll('.quantity-button.plus');
        var removeButtons = document.querySelectorAll('.remove-button');

        // Функция для обновления количества товара в базе данных
        function updateQuantity(cartItemId, newQuantity) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_quantity.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send('id=' + cartItemId + '&quantity=' + newQuantity);
        }

        minusButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var cartItemId = button.getAttribute('data-cart-item-id');
                var quantityElement = document.querySelector('.item-quantity[data-cart-item-id="' + cartItemId + '"]');
                var currentQuantity = parseInt(quantityElement.textContent);
                if (currentQuantity > 1) {
                    var newQuantity = currentQuantity - 1;
                    quantityElement.textContent = newQuantity;
                    updateQuantity(cartItemId, newQuantity);
                }
            });
        });

        plusButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var cartItemId = button.getAttribute('data-cart-item-id');
                var quantityElement = document.querySelector('.item-quantity[data-cart-item-id="' + cartItemId + '"]');
                var currentQuantity = parseInt(quantityElement.textContent);
                var newQuantity = currentQuantity + 1;
                quantityElement.textContent = newQuantity;
                updateQuantity(cartItemId, newQuantity);
            });
        });

        removeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var cartItemId = button.getAttribute('data-cart-item-id');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'cart.php?id=' + cartItemId, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var cartItemElement = document.querySelector('.cart-item[data-cart-item-id="' + cartItemId + '"]');
                        cartItemElement.remove();

                        // Если все товары удалены, показываем сообщение "Корзина пуста"
                        var remainingCartItems = document.querySelectorAll('.cart-item');
                        if (remainingCartItems.length === 0) {
                            document.querySelector('.total-price').style.display = 'none';
                            document.querySelector('.btn_div').style.display = 'none';
                            document.getElementById('empty-cart-message').style.display = 'block';
                        }
                    }
                };
                xhr.send();
            });
        });
    });
</script>
<?php
    } else {
?>
<div class="container mt-5">
    <p class="no-products">Ваша корзина пуста.</p>
</div>
<?php
    }
} else {
?>
<div class="container mt-5">
    <p class="no-products">Пожалуйста, <a href="login.php">войдите</a>, чтобы видеть свою корзину.</p>
</div>
<?php
}
?>
</body>
</html>
