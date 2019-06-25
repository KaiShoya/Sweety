CREATE TABLE IF NOT EXISTS availability (
  id int not null auto_increment primary key,
  hotel_id int,
  availability boolean,
  room_count int,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp,
  UNIQUE(hotel_id)
);

