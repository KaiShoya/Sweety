<?php
include_once '../sys/init.php';
$_SESSION["title"] = PRICE_LIST;
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

    <div id="form">
      <nav class="level">
        <div class="level-left">
          <div class="level-item">利用する曜日</div>
          <div class="level-item" id="day_of_week">
            <button v-for="dow in day_of_week"
                v-bind:class="['button', activeDowId == dow.id ? ' is-primary' : '']"
                v-on:click="click_dow">
              {{ dow.name }}
            </button>
          </div>
        </div>
      </nav>

      <nav class="level">
        <div class="level-left">
          <div class="level-item">利用開始時間</div>
          <div class="level-item select">
            <select name="start_hour"
                v-model="startHour"
                v-on:change="change_start_hour">
              <option v-for="d in [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]">{{d}}</option>
            </select>
            <span>：</span>
            <select name="start_time"
                v-model="startTime"
                v-on:change="change_start_time">
              <option value="00">00</option>
              <option value="15">15</option>
              <option value="30">30</option>
              <option value="45">45</option>
            </select>
          </div>
          <div class="level-item" id="utilization_time">
            <button class="button" v-on:click="now_start_time">今から</button>
            <button class="button" v-on:click="reset_start_time">指定しない</button>
          </div>
        </div>
      </nav>

      <nav class="level">
        <div class="level-left">
          <div class="level-item">利用時間　　</div>
          <div class="level-item">
            <input class="input" type="text" name="utilization_time" style="width: 60px;"
                v-model="utilizationTime"
                v-on:change="change_utilization_time"/>
            <span>分</span>
          </div>
          <div class="level-item" id="utilization_time">
            <button class="button" v-on:click="click_utilization_time(60)">60</button>
            <button class="button" v-on:click="click_utilization_time(90)">90</button>
            <button class="button" v-on:click="click_utilization_time(120)">120</button>
            <button class="button" v-on:click="click_utilization_time(180)">180</button>
            <button class="button" v-on:click="click_utilization_time('Free')">フリータイム</button>
            <button class="button" v-on:click="click_utilization_time('Lodging')">宿泊</button>
          </div>
        </div>
      </nav>

      <label class="checkbox">
        <input type="checkbox" id="card_accepted"
            v-model="cardAccepted"
            v-on:change="change_card_accepted">
        クレジットカード可
      </label>
    </div>

    <table class="table is-hoverable is-bordered">
      <thead>
        <tr>
          <th class="col-md-2">ホテル名</th>
          <th class="col-md-2">曜日</th>
          <th class="col-md-2">最低価格</th>
          <!-- <th class="col-md-2">最高価格</th> -->
          <th class="col-md-2">最大利用時間</th>
          <th class="col-md-2">最終入室時間</th>
          <th class="col-md-2">プラン</th>
          <th class="col-md-2">利用開始</th>
          <th class="col-md-2">利用終了</th>
          <!-- <th class="col-md-2">created_at</th>
          <th class="col-md-2">updated_at</th> -->
        </tr>
      </thead>
      <tbody>
        <tr is="price-row" v-for="price in orderedPrices" :p="price"></tr>
      </tbody>
    </table>
  </div>
  <!-- コンテンツ -->

  <!-- Tableテンプレート -->
  <script type="text/x-template" id="price-row">
    <tr>
      <td>{{ p.hotel_id }}</td>
      <td>{{ p.day_of_week }}</td>
      <td>{{ p.min_price }}</td>
      <!-- <td>{{ p.max_price }}</td> -->
      <td>{{ p.time_diff }}</td>
      <td>{{ p.last_start_time }}</td>
      <td v-if="p.utilization_time == 'Free'">フリー</td>
      <td v-else-if="p.utilization_time == 'Lodging'">宿泊</td>
      <td v-else>{{ p.utilization_time }}分</td>
      <td>{{ p.time_zone_start }}</td>
      <td>{{ p.time_zone_end }}</td>
      <!-- <td>{{ p.created_at }}</td>
      <td>{{ p.updated_at }}</td> -->
    </tr>
  </script>
  <!-- Tableテンプレート -->

  <!-- PHPからJSへ値渡し -->
  <script>
    var dowId = "<?= isset($_REQUEST['dow_id']) ? $_REQUEST['dow_id'] : '0'; ?>";
    
  </script>
  <?php include_once PUB_PATH.'/parts/footer.php'; ?>
</body>
</html>
