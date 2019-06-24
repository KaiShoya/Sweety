<?php
include_once '../sys/init.php';
$_SESSION["title"] = LOGIN;
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once PUB_PATH . '/parts/head.php'; ?>

<body>
  <!-- ナビゲーション -->
  <?php include_once PUB_PATH . '/parts/navbar.php'; ?>
  <!-- ナビゲーション -->

  <!-- コンテンツ -->
  <div class="container">
    <form action="<?= PUBLIC_TOP . '/api/login.php' ?>" method="post">
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">ID</label>
        </div>
        <div class="field-body">
          <div class="field">
            <p class="control">
              <input name="id" class="input" type="text" placeholder="ID">
            </p>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">パスワード</label>
        </div>
        <div class="field-body">
          <div class="field">
            <p class="control">
              <input name="passwd" class="input" type="password" placeholder="パスワード">
            </p>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label"></div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <button class="button is-link" type="submit">サインイン</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- コンテンツ -->

  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>