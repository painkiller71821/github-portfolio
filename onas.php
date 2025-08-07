<?php
    session_start();
    include("core/header.php");
    ?>
    <body class="bg-body-secondary">
   <style>
        /* Стили для карты */
        .map-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
        .map-wrapper {
            position: relative;
            padding-bottom: 75%; /* соотношение сторон 4:3 для увеличения высоты карты */
            height: 0;
            overflow: hidden;
        }
        .map-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <header>
        <div class="container px-3 py-4">
    
        </div>
    </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>С чего всё началось?</h2>
                    <p>Бетонные Джунгли — это мечта, которая воплотилась в жизнь! Это история о том, как предприимчивость и страсть к моде приводят к созданию нарядов, которые выходят за рамки привычных представлений об одежде.</p>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <img src="img/1.jpg">
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row">
            <!-- Отзыв 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Иван П.</h5>
                        <p class="card-text">"Недавно купил здесь худи и кроссовки, и я просто в восторге! Качество отличное, а дизайн – просто огонь! Спасибо за быструю доставку и отличный сервис. Теперь я ваш постоянный клиент!"</p>
                    </div>
                </div>
            </div>
            <!-- Отзыв 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Мария К.</h5>
                        <p class="card-text">"Очень довольна своей покупкой! Заказала джинсы и футболку, и они идеально подошли по размеру. Материалы качественные, все швы ровные. Доставили быстро, в течение нескольких дней. Рекомендую этот магазин всем своим друзьям!"</p>
                    </div>
                </div>
            </div>
            <!-- Отзыв 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Алексей С.</h5>
                        <p class="card-text">"Купил куртку на осень, и она превзошла все мои ожидания. Стильная, теплая и удобная. Магазин предлагает отличные скидки, так что я еще и сэкономил. Обязательно вернусь за новыми вещами!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
<?php
    include("core/footer.php");
?>
