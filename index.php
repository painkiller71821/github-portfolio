<?php
    session_start();
    include("core/header.php");
    $sql = "SELECT id, image_url, product_name, price FROM catalogue LIMIT 3";
$result = $conn->query($sql);
?>

<body class="bg-body-secondary">
<style>
  .carousel-item img {
    width: 1000px;
    height: 700px; 
    object-fit: cover; 
    display: block; 
    margin: 0 auto;
    max-width: 100%;
    object-fit: cover;
  }
  .carousel-control-next-icon {
    transform: translateX(-2000%);
  }

  .carousel-control-prev-icon {
    transform: translateX(2000%);
  }
  .card-img-top {
    height: 200px; /* Установите желаемую высоту изображения */
    object-fit: cover; /* Обрезаем изображения по размерам блока */
  }
  @media (max-width: 768px) {
    .carousel-item img {
        height: auto; /* Автоматически подстраиваем высоту для сохранения пропорций */
    }
}

@media (max-width: 992px) {
    .carousel-control-next-icon,
    .carousel-control-prev-icon {
        display: none; /* Скрываем стрелки на планшетах и мобильных устройствах */
    }
}
</style>


<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/1.jpg" class="d-block" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/2.jpg" class="d-block" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/3.jpg" class="d-block" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




<div class="container px-4 py-5 mx-auto">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Новинки</h2>
        </div>
    </div>
    <div class="row">
        <?php
        // Проверяем, есть ли данные в результате запроса
        if ($result->num_rows > 0) {
            // Выводим данные каждой строки как карточку
            while($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4 mb-3">';
              echo '<div class="card">';
              echo '<img src="' . $row["image_url"] . '" class="card-img-top" alt="Card image">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $row["product_name"] . '</h5>';
              echo '<p class="card-text">' . $row["price"] . ' ₽</p>'; // Добавлен символ рубля
              echo "<a href='#' class='btn btn-dark buy-button' data-product-id='" . $row['id'] . "'>Добавить в корзину +</a>"; // Добавлены классы Bootstrap для стилизации кнопки
              echo '</div>';
              echo '</div>';
              echo '</div>';
          }
        } else {
            echo "0 результатов";
        }
        ?>
    </div>
</div>
</body>
<?php
    include("core/footer.php");
?>