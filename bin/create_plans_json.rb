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
plans = {}
pages.uniq.each do |p|
  doc = get_html("https://happyhotel.jp/searchArea.act?jis_code=45201&page=#{p}")
  doc.xpath('//*[@id="hotels"]//div[@class="right"]//span[@class="name"]//a').each_with_index do |node, i|
    index = p.to_i * 20 + i
    plans[index] = {}
    html = open("https://happyhotel.jp/#{node[:href].gsub("../", "")}").read
    html = html.sub(/^<!DOCTYPE html(.*)$/, '<!DOCTYPE html>')
    hotel = Nokogiri::HTML(html.toutf8, nil, 'utf-8')

    hotel.xpath('//*[@class="tabBody"]//tr[@class="strong"]').each do |tr|
      tmp = tr.css("td").text.strip
      # 改行置換
      tmp = tmp.gsub("\r\n\r\n", "\n")
      # 削除
      tmp = tmp.gsub("\r\n", "")
      tmp = tmp.gsub("\t", "")
      tmp = tmp.gsub("\r\n※表示金額は税込です。", "")
      tmp = tmp.gsub("均一", "")
      plans[index][tr.css("th").text.strip] = tmp
    end
  end
end

puts plans.to_json
