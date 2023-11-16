<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require_once '../component/head.php'; ?>
    <!-- <link rel="stylesheet" href="../../css/book/input_detail.css"> -->
    <title>小説概要入力 | Seiran</title>
    <?php require_once '../component/header.php'; ?>
    <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
    <?php require_once '../component/header.php'; ?>
    <main>
        <section class="has-text-centered">
            <h1>小説を作成する</h1>
        </section>

        <form action="#" method="POST">
            <div class="container mb-6">
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
            </div>

            <div class=" field flex-center">
                <button type="submit" class="button is-primary px-6">作成</button>
            </div>

            <div>
                <p class="has-text-grey">※作成後にエディタ画面に遷移します</p>
            </div>
        </form>
    </main>

</body>

</html>
