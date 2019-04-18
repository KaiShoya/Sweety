<?php
class AccessLogs extends Model {
  public $id = null;
  public $access_time = null;
  public $remote_addr = null;
  public $http_user_agent = null;
  public $count = null;
  public $created_at = null;
  public $updated_at = null;
}

