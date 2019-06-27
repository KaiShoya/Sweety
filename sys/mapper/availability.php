<?php
class AvailabilityMapper extends DataMapper
{
  public function __construct()
  {
    parent::__construct('availability');
  }

  public static function find_by_hotel_id($ids)
  {
    if (is_array($ids)) {
      $sql = 'SELECT availability FROM ' . self::$name . ' WHERE hotel_id IN (' . substr(str_repeat(',?', count($ids)), 1) . ') ORDER BY ' . self::$sort . ';';
      $sth = self::$db->prepare($sql);
      $sth->execute($ids);
    } else {
      $sql = 'SELECT availability FROM ' . self::$name . ' WHERE hotel_id = :id ORDER BY ' . self::$sort . ';';
      $sth = self::$db->prepare($sql);
      $sth->execute(array(':id' => $ids));
    }
    return $sth->fetchAll(PDO::FETCH_COLUMN);
  }
}
