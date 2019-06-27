<?php
class DataMapper
{
  protected static $db;
  protected static $name;
  static $sort;

  public function __construct($name, $id = "id")
  {
    self::$name = $name;
    self::$db = Context::get_pdo();
    self::$sort = $id;
  }

  public static function all()
  {
    $sql = 'SELECT * FROM ' . self::$name . ' ORDER BY ' . self::$sort . ';';
    $sth = self::$db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function find_by_id($id)
  {
    if (is_array($id)) {
      $sql = 'SELECT * FROM ' . self::$name . ' WHERE id IN (' . substr(str_repeat(',?', count($id)), 1) . ') ORDER BY ' . self::$sort . ';';
      $sth = self::$db->prepare($sql);
      $sth->execute($id);
    } else {
      $sql = 'SELECT * FROM ' . self::$name . ' WHERE id = :id ORDER BY ' . self::$sort . ';';
      $sth = self::$db->prepare($sql);
      $sth->execute(array(':id' => $id));
    }
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function find($vendor)
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
    $sql = 'SELECT * FROM ' . self::$name . ' WHERE ' . implode(" AND ", $set) . ' ORDER BY ' . self::$sort . ';';
    // echo $sql;
    // exit;
    $sth = self::$db->prepare($sql);
    $sth->execute($data);
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function latest($limit = 5)
  {
    $sql = 'SELECT * FROM ' . self::$name . ' ORDER BY ' . self::$sort . ' DESC LIMIT ' . $limit . ';';
    $sth = self::$db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function add($vendor)
  {
    $set = array();
    $data = array();
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
    return self::$db->lastInsertId();
  }

  public static function duplicate_update($vendor, $update)
  {
    $set = array();
    $update_key = array();
    $data = array();
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
    foreach ($update as $key => $value) {
      if ($key == 'id') {
        continue;
      }
      if ($value != true) {
        continue;
      }
      array_push($update_key, "$key = :$key");
    }
    $sql = 'INSERT INTO ' . self::$name . ' SET ' . implode(",", $set) . ' ON DUPLICATE KEY UPDATE ' . implode(",", $update_key);
    $sth = self::$db->prepare($sql);
    $sth->execute($data);
    return self::$db->lastInsertId();
  }

  public static function destroy($id)
  {
    $st = self::$db->prepare(
      'DELETE FROM ' . self::$name . ' WHERE
      id = :id'
    );
    $st->execute(array(':id' => $vendor->id));
    return $del->rowCount();
  }
}
