<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require_once '../component/head.php'; ?>
    <link rel="stylesheet" href="../../css/book/input_detail.css">
    <title>小説概要入力 | Seiran</title>
    <?php require_once '../component/header.php'; ?>
    <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
    <?php require_once '../component/header.php'; ?>
    <div class="back">
        <h2>小説を作成する</h2>
        <p>タイトル</p>
        <input type="text" name="name"><br>
        <p>概要</p>
        <textarea rows="5" cols="100">
        </textarea><br>
        <div class="money">
            <p>価格</p>
            <input type="number" name="price">
        </div>
        <div class="category">
            <p>カテゴリー</p>
            <select name="category">
                <option value="1">マッサン</option>
                <option value="2">まっさん</option>
                <option value="3">massan</option>
            </select>
        </div>
        <div class="button">
            <input type="button" value="作成">
        </div>
        <div>
            ※作成後にエディタ画面に遷移します
        </div>
    </div>
</body>

</html>
