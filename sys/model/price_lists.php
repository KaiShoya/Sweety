<?php
class PriceLists extends Model
{
  public $id = null;
  // ホテルid
  public $hotel_id = null;
  // 曜日番号
  public $day_of_week = null;
  // 最低価格
  public $min_price = null;
  // 最高価格
  public $max_price = null;
  // 時間帯
  public $time_zone_start = null;
  public $time_zone_end = null;
  // 利用時間
  public $utilization_time = null;
  public $created_at = null;
  public $updated_at = null;
}
