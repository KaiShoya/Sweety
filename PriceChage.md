ホテル名
曜日
最低価格
プラン
利用開始
利用終了


選択順
- 時間(プラン) 必須
- 利用開始,利用終了 必須
- 最低料金,最大料金 null
- 曜日 必須
- チェックイン or チェックアウト 必須

```sql
hotels
ホテル名: name varchar(255)
住所: address varchar(255)
電話番号: phone varchar(255)
-- マップコード: mapcode varchar(255)
-- 経度: lat varchar(255)
-- 緯度: lon varchar(255)
クレジット: credit_card boolean


price_lists
ホテルid: hotel_id int
週番号: day_of_week int
最低価格: min_price int
最大価格: max_price int
利用開始時間: time_zone_start time
利用終了時間: time_zone_end time
時間: utilization_time varchar(255)
チェックインかチェックアウトか: from_checkin boolean
```