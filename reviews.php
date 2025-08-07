<?php
    session_start();
    include("core/header.php");
    ?>
    <style>
.backend {
    background-size: cover; /* Ensures the background image covers the entire container */
    background-position: center; /* Centers the background image */
    background-repeat: no-repeat; /* Prevents the background image from repeating */
    width: 100%;
    height: 100%;

    top: 0;
    left: 0;
    z-index: -1; /* Places the background behind other elements */
}

.content-container {
    position: relative;
    z-index: 1; /* Ensures the content is above the background */
}
</style>
<section>
    <div class="container px-4 py-5 d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <!-- Форма обратной связи -->
                <div class="contact-form ">
                    <h2 class="text-center">Оставьте свой отзыв</h2>
                    <form action="send_message.php" method="post">
                        <div class="form-group">
                            <label for="name">Ваше имя:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Ваш Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Ваш отзыв:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-block">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../js/main.js"></script> 