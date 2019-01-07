namespace :db do
  def db_reset(dbname, user)
    print "Drop database."
    puts `mysql -u#{user} -e 'drop database #{dbname}'`
    print "Loading schema."
    puts `mysql -u#{user} < sys/db/schema.sql`

    Dir.glob('sys/db/migrate/migration_??????????????.sql').each do |file|
      print "Loading #{file}."
      puts `mysql -u#{user} #{dbname} < #{file}`
    end
    print "Loading seed."
    puts `mysql -u#{user} #{dbname} < sys/db/seed.sql`
  end

  desc 'db reset.'
  task :reset do |task, args|
    dbname = `php -r 'require __DIR__."/sys/core/context.php"; echo DB_NAME;'`
    user = `php -r 'require __DIR__."/sys/core/context.php"; echo DB_USER;'`
    db_reset(dbname,user)
  end
end

namespace :create do
  def migrate(txt="")
    filename = "sys/db/migrate/migration_#{Time.now.strftime("%Y%m%d%H%M%S")}.sql"
    `echo "#{txt}" > #{filename}`
    return filename
  end

  def add_schema(txt="")
    filename = "sys/db/schema.sql"
    unless File.exist?(filename)
      dbname = `php -r 'require __DIR__."/sys/core/context.php"; echo DB_NAME;'`
      `echo "CREATE DATABASE IF NOT EXISTS #{dbname};\n    use #{dbname};" > #{filename}`
    end
    `echo "\n#{txt}" >> #{filename}`
    return filename
  end

  desc 'create migration file.'
  task :migration do |task, args|
    migrate
  end

  desc 'create model name:type[:digit] create:model[test] name:string => varchar(255)'
  task :model, :model_name, :add_schema do |task, args|
    ARGV.slice(1,ARGV.size).each{|v| task v.to_sym do; end}
    unless args[:model_name]
      puts "model_name is need."
      exit
    end
    name = to_snake args[:model_name]
    if File.exists? name
      puts "#{name} is exists."
      exit
    end

    model = "<?php\nclass #{to_camel(name)} extends Model {\n  public \\\$id = null;\n"
    mapper = "<?php\nclass #{to_camel(name)}Mapper extends DataMapper {\n  public function __construct() {\n    parent::__construct('#{name}');\n  }\n}\n"
    migration = "CREATE TABLE IF NOT EXISTS #{name} (\n  id int not null auto_increment primary key,\n"

    ARGV[1..-1].each do |col|
      v = col.split(":")
      model += "  public \\\$#{v[0]} = null;\n"
      migration += "  #{v[0]} #{type_cast v[1]},\n"
    end
    model += "  public \\\$created_at = null;\n  public \\\$updated_at = null;\n}\n"
    migration += "  created_at timestamp not null default current_timestamp,\n  updated_at timestamp not null default current_timestamp on update current_timestamp\n);\n"

    print "Creating model .. "
    `echo "#{model}" > sys/model/#{name}.php`
    puts "ok."
    print "Creating mapper .. "
    `echo "#{mapper}" > sys/mapper/#{name}.php`
    puts "ok."
    if args[:add_schema]
      print "Add schema .. "
      filename = add_schema(migration)
      puts "ok."
    else
      print "Creating migration .. "
      filename = migrate(migration)
      puts "ok."
    end
    puts "Prease check files."
    puts "  sys/model/#{name}.php"
    puts "  #{filename}"
  end
end

namespace :delete do
  desc 'delete model.'
  task :model, :model_name do |task, args|
    unless args[:model_name]
      puts "model_name is need."
      exit
    end
    name = to_snake args[:model_name]
    print "Remove model .. "
    `rm sys/model/#{name}.php`
    puts "ok."
    print "Remove mapper .. "
    `rm sys/mapper/#{name}.php`
    puts "ok."
  end
end

# MySQL用
def type_cast(type, digit=nil)
  if type == 'char'
    return "char(#{digit.kind_of?(Integer) ? digit : '255'})"
  elsif type == 'varchar' || type == 'string'
    return "varchar(#{digit.kind_of?(Integer) ? digit : '255'})"
  elsif digit.kind_of?(Integer)
    "#{type}(#{digit})"
  end
  return type
end

# キャメルケース変換
def to_camel(txt)
  txt.split("_").map{|w| w[0] = w[0].upcase; w}.join
end

# スネークケース変換
def to_snake(txt)
  txt.gsub(/([A-Z]+)([A-Z][a-z])/, '\1_\2')
    .gsub(/([a-z\d])([A-Z])/, '\1_\2')
    .tr("-", "_")
    .downcase
end
