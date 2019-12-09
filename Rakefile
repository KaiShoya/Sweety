require './bin/scaffold.rb'

desc 'deploy to XREA'
task :deploy_xrea do
  host = "s1008.xrea.com"
  username = "sweetyhotel"
  password = "gaQdyTVbBq00"
  `echo 'open -u #{username} -p #{password} #{host}
put index.php
put -R sys/
cd public_html/
put -R pub/*
quit'|ncftp`
end
