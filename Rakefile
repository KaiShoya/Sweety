require './bin/scaffold.rb'

desc 'deploy to StarServer'
task :deploy do
  `echo 'open -u shoya85.starfree.jp -p sdnvwoqiu3r shoya85.starfree.jp
put -R pub/
put -R sys/
quit'|ncftp`
end
