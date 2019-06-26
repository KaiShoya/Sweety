<?php
class PriceListsMapper extends DataMapper
{
  public function __construct()
  {
    parent::__construct('price_lists');
  }

  public static function find_by($vendor)
  {
    $set = array();
    $data = array();
    $select = array();
    $use_time_zone_start = true;
    array_push($select, '*');
    foreach ($vendor as $key => $value) {
      if ($value == null) {
        if ($key == "utilization_time") {
          array_push($select, 'time_zone_start AS last_start_time');
        }
        continue;
      }
      if ($key == "day_of_week") {
        array_push($set, "day_of_week = :day_of_week");
      } elseif ($key == "time_zone_start") {
        if ($value != "00:00:00" && $value != "0:00:00") {
          array_push($set, "time_zone_start <= :time_zone_start");
          array_push($set, "((from_checkin = false AND time_zone_end >= :time_zone_start) OR " .
            "(from_checkin = true AND time_zone_end >= :time_zone_start))");
        }
      } elseif ($key == "utilization_time") {
        if ($value == "Free" || $value == "Lodging") {
          array_push($select, '"" AS last_start_time');
          array_push($set, "utilization_time = :utilization_time");
          if (
            $vendor->time_zone_start != null
            && $vendor->time_zone_start != "00:00:00"
            && $vendor->time_zone_start != "0:00:00"
          ) {
            array_push($select, 'TIMEDIFF(time_zone_end, :time_zone_start) AS time_diff');
          } else {
            array_push($select, 'TIMEDIFF(time_zone_end, time_zone_start) AS time_diff');
            $use_time_zone_start = false;
          }
        } else {
          array_push($select, 'time_zone_end - INTERVAL :utilization_time MINUTE AS last_start_time');
          array_push($select, 'CASE WHEN utilization_time = "Free" OR utilization_time = "Lodging" THEN TIMEDIFF(time_zone_end, :time_zone_start)' .
            'ELSE TIME("00:00:00") + INTERVAL :utilization_time MINUTE END AS time_diff');

          array_push($set, "(CAST(utilization_time AS SIGNED) >= CAST(:utilization_time AS SIGNED) OR " .
            "(utilization_time IN ('Free', 'Lodging') AND (time_zone_end - INTERVAL :utilization_time MINUTE) >= :time_zone_start))");
        }
      } elseif ($key == "credit_card") {
        if ($value) {
          array_push($set, "credit_card = true");
        }
        continue;
      } else {
        continue;
      }
      $data[$key] = $value;
    }

    if (!$use_time_zone_start) {
      unset($data["time_zone_start"]);
    }

    $sql = 'SELECT ' . implode(", ", $select) . ' FROM ' . self::$name . ' LEFT JOIN (SELECT id AS h_id, credit_card FROM hotels) h ON hotel_id = h_id WHERE ' . implode(" AND ", $set) . ' ORDER BY ' . self::$sort . ';';
    $sth = self::$db->prepare($sql);
    $sth->execute($data);
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}
