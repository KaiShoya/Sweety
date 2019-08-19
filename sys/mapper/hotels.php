<?php
class HotelsMapper extends DataMapper
{
  public function __construct()
  {
    parent::__construct('hotels');
  }

  public static function all($getDeleted = false)
  {
    $where = "WHERE deleted = 0";
    if ($getDeleted) {
      $where = "";
    }
    $sql = 'SELECT * FROM ' . self::$name . ' LEFT JOIN (SELECT hotel_id AS a_id, availability, updated_at AS updated_at_availability FROM availability) a ON id = a_id ' . $where . ' ORDER BY ' . self::$sort . ';';
    $sth = self::$db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}
