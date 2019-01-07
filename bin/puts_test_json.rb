# encoding: utf-8
require 'json'

STDOUT.flush

file = File.open('test.json').read
json = JSON.parse(file)

hotel_id = 0
hotel_id = ARGV[0] unless ARGV[0].nil?
puts_plan = nil
puts_plan = ARGV[1] unless ARGV[1].nil?

i = 0
json[hotel_id.to_s].each do |plan, text|
  unless puts_plan.nil?
    if puts_plan == i.to_s
      text.gsub!("\n〜¥", ",")
      text.gsub!("¥", "")
      text.gsub!("翌 ", "翌")
      text.gsub!("\nの間で最大", "")
      text.gsub!("※表示金額は税込です。", "")
      puts plan
      puts text
      puts ""

      tmp = text.split("\n")
      times = (tmp[1].split(" ")[-1]).split(",")
      times[1] = times[0] if times.count == 1

      if plan.include?("フリー")
        utilization_time = "Free" 
      elsif plan.include?("宿泊")
        utilization_time = "Lodging"
      else
        t = tmp[1].split(" ")[1]
        puts t
        if t.include?("1時間30分") || t.include?("1時間半")
          utilization_time = "90"
        elsif t.include?("1時間")
          utilization_time = "60"
        elsif t.include?("3時間30分")
          utilization_time = "210"
        elsif t.include?("3時間20分")
          utilization_time = "200"
        elsif t.include?("3時間")
          utilization_time = "180"
        end
        utilization_time = ""
      end
      # 24時間制 1時間30分ご利用 2700
      puts "(#{hotel_id}, 1, #{times.join(", ")}, \"#{tmp[1].split(" ")[0]}\", \"#{utilization_time}\"),"
    end
  else
    text.gsub!("\n〜¥", ",")
    text.gsub!("¥", "")
    text.gsub!("翌 ", "翌")
    text.gsub!("\nの間で最大", "")
    text.gsub!("※表示金額は税込です。", "")

    puts plan
    puts text
    puts ""

    begin
      tmp = text.split("\n")
      times = (tmp[1].split(" ")[-1]).split(",")
      times[1] = times[0] if times.count == 1
  
      # 24時間制 1時間30分ご利用 2700
      puts "(#{hotel_id}, 1, #{times.join(", ")}, \"#{tmp[1].split(" ")[0]}\", \"\"),"
    rescue => exception
    end
  end
  i += 1
end

# json.each do |hotel_id, data|
#   data.each do |plan, text|
    
#   end
# end
