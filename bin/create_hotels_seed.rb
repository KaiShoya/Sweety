# encoding: utf-8
require 'open-uri'
require 'nokogiri'
require 'json'
require 'kconv'

STDOUT.flush

def get_html(url, charset = nil)
  html = open(url) do |f|
    charset = f.charset if charset == nil
    f.read
  end
  return Nokogiri::HTML.parse(html, nil, charset)
end

doc = get_html("https://happyhotel.jp/searchArea.act?jis_code=45201")
pages = []
doc.xpath('//div[@class="guide top"]//div[@class="pagerNav"]//a').each_with_index do |node, i|
  pages.push node[:href].gsub("searchArea.act?jis_code=45201&page=", "")
end

hotels = []
pages.uniq.each do |p|
  doc = get_html("https://happyhotel.jp/searchArea.act?jis_code=45201&page=#{p}")
  doc.xpath('//*[@id="hotels"]//div[@class="right"]//span[@class="name"]//a').each_with_index do |node, i|
    index = p.to_i * 20 + i
    html = open("https://happyhotel.jp/#{node[:href].gsub("../", "")}").read
    html = html.sub(/^<!DOCTYPE html(.*)$/, '<!DOCTYPE html>')
    hotel = Nokogiri::HTML(html.toutf8, nil, 'utf-8')
    name = hotel.xpath('//*[@id="cHeader"]/h1').text.strip
    address = hotel.xpath('//*[@id="outline"]//dl[@class="data"]/dd[1]/text()').text.strip
    phone = hotel.xpath('//*[@id="outline"]//dl[@class="data"]/dd[2]/text()').text.strip
    mapcode = hotel.xpath('//*[@id="outline"]//dl[@class="data"]/dd[3]/text()').text.strip

    creadit = false
    hotel.xpath('//*[@class="tabBody"]//tr').each do |tr|
      if tr.css("th").text.strip.include?("支払い/クレジットカード")
        creadit = tr.css("td").text.strip.include?("カード：可")
      end
    end

    hotels.push "(#{index}, '#{name}', '#{address}', '#{phone}', '#{mapcode}', null, null, #{creadit})"
  end
end

puts "INSERT INTO hotels (id,name,address,phone,mapcode,lat,lon,credit_card) values"
puts "  " + hotels.join(",\n  ") + ";"
