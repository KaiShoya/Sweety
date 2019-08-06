<?php
include_once '../sys/init.php';
$_SESSION["title"] = MAP;
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
    <div id="chartdiv"></div>
  </div>
  <!-- コンテンツ -->

  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
  <script src="//www.amcharts.com/lib/4/core.js"></script>
  <script src="//www.amcharts.com/lib/4/maps.js"></script>
  <script src="//www.amcharts.com/lib/4/geodata/japanLow.js"></script>
  <script>
    var app = new Vue({
      el: ".container",
      mounted() {
        let map = am4core.create("chartdiv", am4maps.MapChart)
        map.geodata = am4geodata_japanLow
        let polygonSeries = map.series.push(new am4maps.MapPolygonSeries())
        polygonSeries.mapPolygons.template.fill = am4core.color("#47c78a")
        polygonSeries.useGeodata = true
        polygonSeries.mapPolygons.template.events.on("hit", function(ev) {
          map.zoomToMapObject(ev.target)
        })

        polygonSeries.include = [
          "JP-40",
          "JP-41",
          "JP-42",
          "JP-43",
          "JP-44",
          "JP-45",
          "JP-46",
          // "JP-47",
        ]
      },
      beforeDestroy() {
        if (this.map) {
          this.map.dispose()
        }
      }
    })
  </script>
</body>

</html>