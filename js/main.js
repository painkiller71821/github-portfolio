$(document).ready(function () {
    // Привязываем обработчик события клика к родительскому элементу
    $('.container').on('click', '.buy-button', function (e) {
        e.preventDefault();

        var productId = $(this).data('product-id');

        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: {
                product_id: productId
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Статус: " + status);
                console.error("Ошибка: " + error);
                console.error("Ответ сервера: " + xhr.responseText);
                alert('Ошибка при добавлении товара в корзину');
            }
        });
    });
});


// Авторизация
$('.auth_btn').click(function(e){
    e.preventDefault();
    $(`input`).removeClass('error');
    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();

    $.ajax({
        url: '../vendor/auth_back.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success: function(data){
            if(data.status === true){
                document.location.href = '../vendor/profile.php';
            }
            else{
                if (data.type === 1){
                    data.fields.forEach(function(field){
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }
    });

});

// Регистрация

$('.register_btn').click(function(e){
e.preventDefault();
$(`input`).removeClass('error');
let login = $('input[name="login"]').val();
let email = $('input[name="email"]').val();
let password = $('input[name="password"]').val();
let password_confirm = $('input[name="password_confirm"]').val();

let formData = new FormData();
formData.append('login',login);
formData.append('email',email);
formData.append('password',password);
formData.append('password_confirm',password_confirm);

$.ajax({
    url: '../vendor/reg_back.php',
    type: 'POST',
    dataType: 'json',
    processData: false, 
    contentType: false,
    data: formData,
    success: function(data){
        if(data.status === true){
            document.location.href = '../vendor/auth.php';
        }
        else{
            if (data.type === 1){
                data.fields.forEach(function(field){
                    $(`input[name="${field}"]`).addClass('error');
                });
            }
            $('.msg').removeClass('none').text(data.message);
        }
    }
});

});

(function($) {

"use strict";

$('nav .dropdown').hover(function(){
    var $this = $(this);
    $this.addClass('show');
    $this.find('> a').attr('aria-expanded', true);
    $this.find('.dropdown-menu').addClass('show');
}, function(){
    var $this = $(this);
        $this.removeClass('show');
        $this.find('> a').attr('aria-expanded', false);
        $this.find('.dropdown-menu').removeClass('show');
});

})(jQuery);
// Добавление в корзину
function updateCartCount() {
    $.ajax({
        type: "GET",
        url: "../get_cart_count.php", 
        success: function (count) {
            $(".cart-count").text(count);
        }
    });
}

updateCartCount();



