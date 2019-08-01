require './bin/scaffold.rb'

desc 'deploy to StarServer'
task :deploy_starserver do
  host = "shoya85.starfree.jp"
  username = "shoya85.starfree.jp"
  password = "sdnvwoqiu3r"
  `echo 'open -u #{username} -p #{password} #{host}
put index.php
put -R sys/
mkdir sweety/
cd sweety/
put -R pub/*
quit'|ncftp`
end

desc 'deploy to SREA'
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
