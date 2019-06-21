<?php
include_once '../sys/init.php';
$_SESSION["title"] = TOS;
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once PUB_PATH.'/parts/head.php'; ?>
<body>
  <!-- ナビゲーション -->
  <?php include_once PUB_PATH.'/parts/navbar.php'; ?>
  <!-- ナビゲーション -->

  <!-- コンテンツ -->
  <div class="container">
    <section class="section">
      <div class="container">
        <h1 class="title">利用規約</h1>
        <p>カップル向けホテル検索サイト「Sweety」（以下「本サイト」といいます。）の利用について、以下のとおり本規約を定めます。</p>
        <br>
        <p>本規約は本サイトが提供するサービスについて規定したものです。</p>
        <br>
        <p>本サイトの情報は管理人が独自に収集したものです。</p>
        <p>情報が古かったり間違っていたりする場合があります。</p>
        <br>
        <p>本サービスに起因してユーザーに生じたあらゆる損害について一切の責任を負いません。</p>
        <br>
        <p>本サイトは、ユーザーに通知することなく、本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし、これによってユーザーに生じた損害について一切の責任を負いません。</p>
      </div>
    </section>
  </div>
  <!-- コンテンツ -->

  <?php include_once PUB_PATH.'/parts/footer.php'; ?>
</body>
</html>
