CREATE TABLE IF NOT EXISTS users (
  id int not null auto_increment primary key,
  login_id varchar(255),
  name varchar(255),
  password varchar(255),
  role varchar(255),
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp,
  UNIQUE(login_id)
);

