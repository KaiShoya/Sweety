require 'yaml'
require './bin/scaffold.rb'
environments = YAML.load_file("./environments.yaml")

desc 'deploy to XREA'
task :deploy_xrea do
  `echo 'open -u #{environments["username"]} -p #{environments["password"]} #{environments["host"]}
put index.php
put -R sys/
cd public_html/
put -R pub/*
quit'|ncftp`
end
