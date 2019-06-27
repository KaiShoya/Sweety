<?php
class UserHotelsMapper extends DataMapper
{
  public function __construct()
  {
    parent::__construct('user_hotels');
  }

  public static function get_hotel_ids($vendor)
  {
    $set = array();
    $data = array();
    foreach ($vendor as $key => $value) {
      if ($value == null) {
        continue;
      }
      array_push($set, "$key = :$key");
      $data[$key] = $value;
    }
    $sql = 'SELECT hotel_id FROM ' . self::$name . ' WHERE ' . implode(" AND ", $set) . ' ORDER BY ' . self::$sort . ';';
    // echo $sql;
    // exit;
    $sth = self::$db->prepare($sql);
    $sth->execute($data);
    return $sth->fetchAll(PDO::FETCH_COLUMN);
  }
}
