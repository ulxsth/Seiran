<?php
session_start();
if(!isset($_SESSION["user"]["isAdmin"])) {
  header('Location: /seiran/view/admin/login.php');
  exit;
}

// ユーザ一覧を取得
require_once __DIR__ . '/../../src/usecase/user/FetchAllUserUseCase.php';
$users = FetchAllUserUseCase::execute();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ここにタイトル | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/confirm_publish.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td>
              <a href="/seiran/view/admin/profile.php?id=<?php echo $user['id']; ?>">
                <?php echo $user['name']; ?>
              </a>
            </td>
            <td><?php echo $user['email']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
  <main>

  </main>
</body>

</html>
