<?php
include_once '../../sys/init.php';
$_SESSION["title"] = PRICE_CHANGE;
Context::login_check();
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
    現在準備中です。
  </div>
  <!-- コンテンツ -->

  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>