CREATE DATABASE IF NOT EXISTS kaisdev;
use kaisdev;

CREATE TABLE IF NOT EXISTS hotels (
  id int not null auto_increment primary key,
  name varchar(255) default null,
  address varchar(255) default null,
  phone varchar(255) default null,
  mapcode varchar(255) default null,
  lat varchar(255) default null,
  lon varchar(255) default null,
  credit_card boolean default null,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);


CREATE TABLE IF NOT EXISTS price_lists (
  id int not null auto_increment primary key,
  hotel_id int default null,
  -- 1:月〜7:日,8:祝日,9:祝日前
  day_of_week int default null,
  min_price int default null,
  max_price int default null,
  time_zone_start time default '0:00',
  time_zone_end time default '0:00',
  utilization_time varchar(255) default null,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);

