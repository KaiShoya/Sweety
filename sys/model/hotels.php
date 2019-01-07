<?php
class Hotels extends Model {
  public $id = null;
  // ホテル名
  public $name = null;
  // 住所
  public $address = null;
  // 電話番号
  public $phone = null;
  public $mapcode = null;
  // 緯度
  public $lat = null;
  // 経度
  public $lon = null;
  // クレジットカード可否
  public $credit_card = null;
  public $created_at = null;
  public $updated_at = null;
}

