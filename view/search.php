<?php session_start();
require_once dirname(__DIR__, 2) . '/seiran/src/usecase/book/SearchBookByNameUseCase.php';
require_once dirname(__DIR__, 2) . '/seiran/src/usecase/user/SearchUserByNameUseCase.php';

$name = $_POST['keyword'];
$bookDTOList = SearchBookByNameUseCase::execute($name);
$userDTOList = SearchUserByNameUseCase::execute($name);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require('component/head.php'); ?>
  <title>検索 | Seiran</title>
</head>

<body>
  <?php require_once 'component/header.php'; ?>

  <!-- ↓コンフリクトが起きた際は消しといてください -->
  <?php
  foreach ($bookDTOList as $bookDTO) {
    var_dump($bookDTO);
    echo '<br>';
  }

  foreach ($userDTOList as $userDTO) {
    var_dump($userDTO);
    echo '<br>';
  }
  ?>
  <!-- ↑ここまで -->
</body>

</html>
