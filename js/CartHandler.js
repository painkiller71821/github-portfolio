function addToCart(productId) {
    // Отправка запроса на сервер для добавления товара в корзину
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Если запрос выполнен успешно, обновляем содержимое корзины на странице
                updateCartView();
            } else {
                // Если произошла ошибка, выводим сообщение об ошибке
                console.error('Ошибка при добавлении товара в корзину:', xhr.responseText);
            }
        }
    };
    xhr.send('product_id=' + productId);
}

// Находим все кнопки "Купить" с помощью селектора класса
var buyButtons = document.querySelectorAll('.buy-button');

// Добавляем обработчик события клика на каждую кнопку "Купить"
buyButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        // Отменяем стандартное действие кнопки (переход по ссылке)
        event.preventDefault();
        
        // Получаем ID товара из атрибута data-product-id
        var productId = button.getAttribute('data-product-id');

        // Вызываем функцию для добавления товара в корзину
        addToCart(productId);
    });
});

function updateCartView() {
    // Обновление отображения корзины на странице
    // Например, можно обновить содержимое таблицы корзины или общую сумму
}