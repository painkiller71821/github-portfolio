<?php
session_start();
include("core/header.php");

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Подключение к базе данных
    include("core/connect.php");

    // Запрос на получение всех комментариев из базы данных
    $sql = "SELECT * FROM reviews";
    $result = $conn->query($sql);

    ?>

    <!-- Административная панель -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Просмотр всех отзывов</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($result->num_rows > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Имя</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Сообщение</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= htmlspecialchars($row['name']); ?></td>
                                                <td><?= htmlspecialchars($row['email']); ?></td>
                                                <td><?= htmlspecialchars($row['message']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center">Нет комментариев для отображения.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Закрытие соединения с базой данных
    $conn->close();

} else {
    header("Location: auth.php");
    exit;
}
?>
