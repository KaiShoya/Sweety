<?php
class PriceListsMapper extends DataMapper {
  public function __construct() {
    parent::__construct('price_lists');
  }

  public static function find_by($vendor) {
    $set = array();
    $data = array();
    foreach ($vendor as $key => $value) {
      if ($value == null) {continue;}
      if ($key == "day_of_week") {
        array_push($set,"day_of_week = :day_of_week");
      } elseif ($key == "time_zone_start") {
        array_push($set,"time_zone_start <= :time_zone_start");
      } elseif ($key == "time_zone_end") {
        array_push($set,"time_zone_end >= :time_zone_end");
      } elseif ($key == "utilization_time") {
        if ($value == "Free" || $value == "Lodging") {
          array_push($set,"utilization_time = :utilization_time");
        } else {
          array_push($set,"(CAST(utilization_time AS SIGNED) >= CAST(:utilization_time AS SIGNED) OR ".
              "(utilization_time IN ('Free', 'Lodging')) AND (time_zone_end - INTERVAL :utilization_time MINUTE) >= :time_zone_start)");
        }
      } else {
        continue;
      }
      $data[$key] = $value;
    }
    $sql = 'SELECT *, time_zone_end - INTERVAL :utilization_time MINUTE AS last_start_time, CASE WHEN utilization_time IN ("Free", "Lodging") THEN TIMEDIFF(time_zone_end, :time_zone_start) ELSE TIME("00:00:00") + INTERVAL :utilization_time MINUTE END AS time_diff FROM '.self::$name.' WHERE '.implode(" AND ", $set).' ORDER BY '.self::$sort.';';
    $sth = self::$db->prepare($sql);
    $sth->execute($data);
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}

