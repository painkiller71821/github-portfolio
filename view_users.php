<?php
session_start();
include('core/header.php');
include('core/connect.php');

// Проверяем, является ли текущий пользователь администратором
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: auth.php");
    exit;
}

// Запрос на выборку всех пользователей из таблицы users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Список пользователей</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Логин</th>
                                        <th>Email</th>
                                        <th>Роль</th>
                                    </tr>
                                </thead>
                                <tbody>';

    // Выводим данные каждого пользователя в таблицу
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                  <td>' . $row['id'] . '</td>
                  <td>' . $row['login'] . '</td>
                  <td>' . $row['email'] . '</td>
                  <td>' . ($row['role'] == 1 ? 'Администратор' : 'Пользователь') . '</td>
              </tr>';
    }

    echo '</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>';
echo '
<div class="text-center mt-3">
    <a href="admin_panel.php" class="btn btn-dark">Назад к админ панели</a>
</div>
</div>
</div>
</div>
</div>
</div>';

} else {
    echo '<p class="text-center mt-5">Пользователей не найдено.</p>';
}

$conn->close();
?>
