<?php
class SearchLogsMapper extends DataMapper {
  public function __construct() {
    parent::__construct('search_logs');
  }

  // idを指定してアップデート
  // TODO: data_mapperに写すべき？
  public static function update($vendor) {
    $set = array();
    $data = array();

    foreach ($vendor as $key => $value) {
      if ($key == 'id') {continue;}
      if ($value == null) {continue;}
      array_push($set,"$key = :$key");
      $data[$key] = $value;
    }
    $sql = 'UPDATE '.self::$name.' SET '.implode(",", $set).' WHERE id = '.$vendor->id;
    $sth = self::$db->prepare($sql);
    $sth->execute($data);
    return $sth->rowCount();
  }
}

