CREATE TABLE IF NOT EXISTS access_logs (
  id int not null auto_increment primary key,
  access_time timestamp not null default current_timestamp,
  remote_addr varchar(255),
  http_user_agent varchar(255),
  count integer,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp,
  UNIQUE(access_time,remote_addr,http_user_agent)
);

