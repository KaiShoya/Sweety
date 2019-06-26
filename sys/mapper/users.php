<?php
class UsersMapper extends DataMapper
{
  public function __construct()
  {
    parent::__construct('users');
  }

  public function login($id, $passwd)
  {
    $sql = 'SELECT * FROM ' . self::$name . ' WHERE login_id = :id AND password = :password ORDER BY ' . self::$sort . ';';
    $sth = self::$db->prepare($sql);
    $sth->execute(array(
      ":id" => $id,
      ":password" => $passwd
    ));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}
