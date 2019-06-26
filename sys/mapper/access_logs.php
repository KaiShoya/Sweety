<?php
class AccessLogsMapper extends DataMapper
{
  public function __construct()
  {
    parent::__construct('access_logs');
  }

  public static function add_count($vendor)
  {
    $set = array();
    $data = array();

    $log = parent::find($vendor);
    if (count($log) > 0) {
      $sql = 'UPDATE ' . self::$name . ' SET count = count + 1 WHERE id = ' . $log[0]["id"];
      $sth = self::$db->query($sql);
    } else {
      $vendor->count = 1;
      foreach ($vendor as $key => $value) {
        if ($key == 'id') {
          continue;
        }
        if ($value == null) {
          continue;
        }
        array_push($set, "$key = :$key");
        $data[$key] = $value;
      }
      $sql = 'INSERT INTO ' . self::$name . ' SET ' . implode(",", $set);
      $sth = self::$db->prepare($sql);
      $sth->execute($data);
    }
    return $sth->rowCount();
  }
}
