<?php
session_start();
include("core/header.php");
?>
<style>
    /* Дополнительные стили для формы */
    .form-container {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-top: 50px;
    }
</style>
</head>
<body class="bg-body-secondary">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Вход в личный кабинет</h2>
                        
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>

                        <form action="auth_back.php" method="post">
                            <div class="form-group">
                                <label for="login">Логин:</label>
                                <input type="text" class="form-control" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-dark btn-block">Войти</button>
                        </form>
                        <p class="text-center mt-3">Еще нет аккаунта? - <a href="register.php" class="text-primary" data-toggle="modal" data-target="#registrationModal">Зарегистрироваться</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationModalLabel">Регистрация</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Форма регистрации -->
                    <form id="registerForm" action="reg_back.php" method="post">
                        <div class="form-group">
                            <label for="reg_login">Логин:</label>
                            <input type="text" class="form-control" id="reg_login" name="login" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_email">E-mail:</label>
                            <input type="email" class="form-control" id="reg_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_password">Пароль:</label>
                            <input type="password" class="form-control" id="reg_password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Подтверждение пароля:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const login = document.getElementById('reg_login').value;
            const email = document.getElementById('reg_email').value;
            const password = document.getElementById('reg_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            const loginRegex = /^[a-zA-Z0-9_]+$/;
            if (!loginRegex.test(login)) {
                alert('Логин должен содержать только английские буквы, цифры и символ подчеркивания.');
                event.preventDefault();
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Введите действительный email.');
                event.preventDefault();
                return false;
            }

            const passwordRegex = /^[a-zA-Z0-9]+$/;
            if (!passwordRegex.test(password)) {
                alert('Пароль должен содержать только английские буквы и цифры.');
                event.preventDefault();
                return false;
            }

            if (password !== confirmPassword) {
                alert('Пароли не совпадают.');
                event.preventDefault();
                return false;
            }
        });

        // JavaScript для модального окна
        $('#registrationModal').on('shown.bs.modal', function () {
            $('#registerForm').trigger('focus');
        });
    </script>
</body>
</html>
