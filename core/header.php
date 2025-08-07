<?php
session_start();
  include("connect.php");
?>

<!doctype html> 
<html lang="en">
  <head>
  	<title>Concrete Jungle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>


	<nav class="navbar bg-body-tertiary fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white position-absolute top-0 start-50 translate-middle-x" href="../index.php"><img src="../img/Concrete Jungle.png" height="20px" width="230px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><img src="../img/burger.png"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../catalog.php">Каталог</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../onas.php">О нас</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../reviews.php">Отзывы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../cart.php">Корзина</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../profile.php">Личный кабинет</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../models.php">3d-модели</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
	<div class="px-4 py-5"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>