<?php
include_once '../sys/init.php';
$_SESSION["title"] = HOTEL_LIST;
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
    <div class="box" is="hotel-row" v-for="hotel in hotels" :h="hotel"></div>
  </div>
  <!-- コンテンツ -->

  <!-- テンプレート -->
  <script type="text/x-template" id="hotel-row">
    <div>
      <article class="media">
        <div class="media-content">
          <div class="content">
            <p>
              <!-- <span class="tag is-success">
                <small>空き状況:1日前</small>
              </span> -->
              <span v-if="h.credit_card == '1'" class="tag is-info">
                <small>クレカOK</small>
              </span>
              <br>
              <strong style="font-size: 1.2rem;line-hight: 10px;">{{ h.name }}</strong>
              <br>
              <small>{{ h.address }}</small>
              <small><a :href="`tel:${ h.phone }`">{{ h.phone }}</a></small>
            </p>
          </div>
        </div>
      </article>
    </div>
  </script>
  <!-- テンプレート -->

  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>