<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>小説編集 | Seiran</title>
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <section class="has-text-centered is-size-2">
      <h1>小説を編集する</h1>
    </section>

    <form action="#" method="POST">
      <div class="container my-6">
        <div class="field">
          <label for="title">タイトル</label>
          <input class="input" type="text" name="title"><br>
        </div>
        <div class="field">
          <label for="description">概要</label>
          <textarea name="description" class="textarea"></textarea>
        </div>
        <div class="field is-flex">
          <section class="mr-6">
            <label for="price">価格</label>
            <input class="input" type="number" name="price">
          </section>
          <section>
            <label for="category">カテゴリー</label>
            <div class="select">
              <select name="category">
                <option value="1">マッサン</option>
                <option value="2">まっさん</option>
                <option value="3">massan</option>
              </select>
            </div>
          </section>
        </div>
        <div>
          <label>概要</label>
          <button type="submit" class="button is-info is-outlined mr-6">エディタで編集</button>
        </div>
      </div>

      <div class=" field flex-center">
        <button type="submit" class="button is-primary px-6">更新</button>
      </div>
    </form>
  </main>
</body>

</html>
