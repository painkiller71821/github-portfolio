<?php
session_start();
include("core/header.php");
include("core/connect.php"); // Подключаем файл с подключением к базе данных

// Проверяем, был ли передан идентификатор товара для добавления в корзину
if(isset($_POST['product_id'])) {
    // Получаем идентификатор товара из запроса
    $productId = $_POST['product_id'];

    // Добавляем товар в корзину в сессии
    $_SESSION['cart'][$productId] = 1; // Пусть значение 1 означает количество товаров

    // Если идентификатор товара не был передан, возвращаем сообщение об ошибке
}

// Выполняем запрос на получение информации о товарах
$sql = "SELECT id, image_url, product_name, price, model_url FROM catalogue LIMIT 6";
$result = $conn->query($sql);
?>

<style>
.card-img-top {
    height: 200px; /* Установите желаемую высоту изображения */
    object-fit: cover; /* Обрезаем изображения по размерам блока */
}
</style>

<head>
    <script src="https://cdn.jsdelivr.net/npm/three@0.130.1/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.130.1/examples/js/loaders/GLTFLoader.js"></script>
</head>

<body class="bg-body-secondary">
<div class="container px-4 py-4 mx-auto">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Каталог</h2>
        </div>
    </div>

    <div class="row">
    <?php
    // Ваш код PHP для получения данных товаров и URL моделей

    // Проверяем, есть ли данные в результате запроса
    if ($result && $result->num_rows > 0) {
        // Выводим данные каждой строки как карточку
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-3">';
            echo '<div class="card">';
            echo '<img src="' . $row["image_url"] . '" class="card-img-top" alt="Card image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row["product_name"] . '</h5>';
            echo '<p class="card-text">' . $row["price"] . ' ₽</p>';
            // Форма для отправки товара в корзину
            echo "<a href='#' class='btn btn-dark buy-button' data-product-id='" . $row['id'] . "'>Добавить в корзину +</a>";
            echo "<a href='#' class='btn btn-outline-secondary ml-1 info-button' data-product-id='" . $row['id'] . "' data-product-info='" . json_encode($row) . "'>Подробнее</a>"; // Добавлены классы Bootstrap для стилизации кнопки

            // Добавляем ссылку на просмотр 3D модели
            if(isset($row['model_url']) && !empty($row['model_url'])) {
                echo "<a href='https://gltf-viewer.donmccurdy.com/?model=" . urlencode($row['model_url']) . "' target='_blank' class='btn btn-outline-info mt-3'>Посмотреть 3D модель</a>";
            }

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

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img id="productImage" class="d-block w-100 img-fluid" alt="Product Image">
                        </div>
                        <div class="carousel-item">
                            <div id="product3DModel" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <h5 id="productName" class="mt-3"></h5>
                <p id="productDescription"></p>
                <p id="productPrice"></p>
                <button id="addToCartBtn" class="btn btn-dark">Добавить в корзину</button>
                <div class="alert alert-success alert-dismissible fade mt-2" role="alert" id="addToCartAlert">
                    Товар добавлен в корзину
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = new bootstrap.Modal(document.getElementById('productModal'));
    var productName = document.getElementById('productName');
    var productDescription = document.getElementById('productDescription');
    var productPrice = document.getElementById('productPrice');
    var addToCartBtn = document.getElementById('addToCartBtn');
    var productImage = document.getElementById('productImage');
    var product3DModel = document.getElementById('product3DModel');

    var infoButtons = document.querySelectorAll('.info-button');
    infoButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var productInfo = JSON.parse(button.getAttribute('data-product-info'));
            productName.textContent = productInfo.product_name;
            productDescription.textContent = productInfo.description;
            productPrice.textContent = 'Цена: ' + productInfo.price + ' ₽';
            productImage.src = productInfo.image_url;
            addToCartBtn.setAttribute('data-product-id', productInfo.id);

            console.log("Product Info: ", productInfo); // Debug information

            if (productInfo.model_url) {
                console.log("Loading 3D model from URL: ", productInfo.model_url); // Debug information
                init3DModel(productInfo.model_url);
            }

            modal.show();
        });
    });

    addToCartBtn.addEventListener('click', function() {
        var productId = this.getAttribute('data-product-id');
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Товар успешно добавлен в корзину");
                    showAddToCartAlert();
                } else {
                    console.error("Ошибка при добавлении товара в корзину");
                }
            }
        };
        xhr.send("product_id=" + productId);
    });

    function showAddToCartAlert() {
        var alert = document.getElementById('addToCartAlert');
        alert.classList.add('show');
        setTimeout(function() {
            alert.classList.remove('show');
        }, 3000);
    }

    function init3DModel(modelUrl) {
        // Clear previous model
        while (product3DModel.firstChild) {
            product3DModel.removeChild(product3DModel.firstChild);
        }

        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(75, product3DModel.clientWidth / product3DModel.clientHeight, 0.1, 1000);
        var renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(product3DModel.clientWidth, product3DModel.clientHeight);
        product3DModel.appendChild(renderer.domElement);

        var loader = new THREE.GLTFLoader();
        loader.load(modelUrl, function (gltf) {
            console.log("Model loaded successfully"); // Debug information
            var model = gltf.scene;
            model.traverse(function(node) {
                if (node.isMesh) {
                    node.castShadow = true;
                    node.receiveShadow = true;
                }
            });

            model.position.set(0, 0, 0); // Ensure model is centered
            model.scale.set(1, 1, 1); // Adjust scale if necessary
            scene.add(model);
            renderer.render(scene, camera);

            // Add light to the scene
            var light = new THREE.DirectionalLight(0xffffff, 1);
            light.position.set(0, 10, 10).normalize();
            scene.add(light);

            camera.lookAt(model.position); // Ensure camera is pointing at the model

            // Adjust camera position based on model size
            var boundingBox = new THREE.Box3().setFromObject(model);
            var size = boundingBox.getSize(new THREE.Vector3());
            var center = boundingBox.getCenter(new THREE.Vector3());
            var maxDim = Math.max(size.x, size.y, size.z);
            var fov = camera.fov * (Math.PI / 180);
            var cameraZ = Math.abs(maxDim / 4 * Math.tan(fov * 2));
            camera.position.z = cameraZ;
            camera.position.y = center.y;
            camera.lookAt(center);

        }, undefined, function (error) {
            console.error("Error loading model: ", error); // Debug information
        });

        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }
        animate();
    }
});



</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../js/main.js"></script>
</body>
<?php
include("core/footer.php");
?>
