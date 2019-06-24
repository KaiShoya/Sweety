CREATE TABLE IF NOT EXISTS user_hotels (
  id int not null auto_increment primary key,
  user_id int,
  hotel_id int,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);

