<header>
  <a href="">
    <img src="/seiran/assets/img/logo.svg" alt="Service logo">
  </a>

  <!-- TODO: ユーザのログイン状態によって切り替え -->
  <!-- ログイン時 -->
  <?php if (true) : ?>
    

  <!-- 未ログイン時 -->
  <?php else : ?>
    <button type="button" onClick="location.href='/seiran/view/auth/login_id.php'">ログイン</button>
    <button type="button" onClick="location.href='/seiran/view/auth/signin.php'">新規登録</button>
    <p>test2</p>
  <?php endif; ?>
</header>
