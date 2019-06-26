<?php
class Model
{
  public static function create($object)
  {
    $class = get_called_class();
    $model = new $class;
    foreach ($object as $key => $value) {
      if (!property_exists($class, $key)) {
        continue;
      }
      $model->$key = $value;
    }
    return $model;
  }

  public static function get_class()
  {
    return get_called_class();
  }
}
