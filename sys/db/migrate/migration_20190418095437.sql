CREATE TABLE IF NOT EXISTS search_logs (
  id int not null auto_increment primary key,
  day_of_week int,
  time_zone_start time,
  utilization_time varchar(255),
  card_accepted boolean,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);

