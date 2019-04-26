require './bin/scaffold.rb'

desc 'deploy to StarServer'
task :deploy do
  `echo 'open -u shoya85.starfree.jp -p sdnvwoqiu3r shoya85.starfree.jp
put -R sys/
mkdir sweety/
cd sweety/
put -R pub/*
quit'|ncftp`
end
