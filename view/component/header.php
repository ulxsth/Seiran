<header class="mb-2">
  <div id="header-top" class="bg-aliceblue">
    <div class="wrapper p-3">

      <!-- サービスロゴ -->
      <div class="container">
        <div id="header-service_logo">
          <a href="/seiran/view/book/info.php">
            <img src="/seiran/assets/img/logo.svg" alt="Service logo">
          </a>
        </div>
      </div>

      <!-- プロフィールアイコン / ログイン・新規登録ボタン -->
      <div class="container has-text-right">

        <!-- ログイン時 -->
        <?php if (isset($SESSION["user"])) : ?>
          <!-- TODO: 自分のユーザーidを挿入するように -->
          <div id="header-user_icon">
            <a href="/seiran/view/user/show.php">
              <img src="/seiran/assets/img/anonimous.svg" alt="user icon">
            </a>
          </div>

          <!-- 未ログイン時 -->
        <?php else : ?>
          <button class="btn button-reset" type="button" onClick="location.href='/seiran/view/auth/login_id.php'">ログイン</button>
          <button class="btn button-submit" type="button" onClick="location.href='/seiran/view/auth/signin.php'">新規登録</button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- ナビゲーションバー -->
  <div id="header-nav" class="bg-seiran">

    <!-- 小説を書く/読む ボタン -->
    <div class=" container">
      <div class="nav-item" id="header-write_book">
        <a href="/seiran/view/book/editor.php">
          <i class="fa-solid fa-file-pen fa-lg has-text-white"></i>
          <span>小説を書く</span>
        </a>
      </div>
      <div class="nav-item" id="header-read_book">
        <a href="/seiran/view/book/library.php">
          <i class="fa-solid fa-book-bookmark fa-lg has-text-white"></i>
          <span>小説を読む</span>
        </a>
      </div>
    </div>

    <!-- 検索フォーム -->
    <div class="container is-flex is-justify-content-flex-end">
      <div id="header-search">
        <form action="/seiran/view/search.php" method="get">
          <div class="control has-icons-right">
            <input type="text" name="keyword" placeholder="検索" class="input is-small px-2">
            <span class="icon is-small is-right">
              <i class="fas fa-search"></i>
            </span>
        </form>
        </form>
      </div>
    </div>
  </div>
</header>
