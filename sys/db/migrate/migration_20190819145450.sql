ALTER TABLE hotels ADD COLUMN website varchar(255) default null AFTER deleted;

UPDATE hotels SET website = 'https://hotelark-mk.com' WHERE id = 1; -- ホテル アーク
UPDATE hotels SET website = 'http://room-mode.com/' WHERE id = 3; -- HOTEL ROOM
UPDATE hotels SET website = null WHERE id = 2; -- ホテル パリス
UPDATE hotels SET website = 'http://www.hotenavi.com/valencia/index.html' WHERE id = 4; -- バレンシア
UPDATE hotels SET website = 'http://www.nokio.jp/ciao.html' WHERE id = 5; -- Ciao
UPDATE hotels SET website = 'http://www.nokio.jp/santa.html' WHERE id = 6; -- サンタのお家
UPDATE hotels SET website = 'http://www.hotenavi.com/hotelparco/index.html' WHERE id = 7; -- ホテル パルコ
UPDATE hotels SET website = 'https://riverside-mk.com' WHERE id = 8; -- リバーサイド
UPDATE hotels SET website = 'https://www.sun21aoshima.com' WHERE id = 9; -- ホテル サン21
UPDATE hotels SET website = 'http://www.hotel-ivy.com' WHERE id = 10; -- HOTEL IVY
UPDATE hotels SET website = null WHERE id = 11; -- T-WAVE
UPDATE hotels SET website = null WHERE id = 12; -- ホテル エスタ
UPDATE hotels SET website = null WHERE id = 13; -- PECHE
UPDATE hotels SET website = null WHERE id = 14; -- HOTEL SUNSHINE
UPDATE hotels SET website = null WHERE id = 15; -- ホテル 2ing
UPDATE hotels SET website = null WHERE id = 16; -- Uno 一ツ葉倶楽部
UPDATE hotels SET website = null WHERE id = 17; -- ホテル フランス
UPDATE hotels SET website = null WHERE id = 18; -- ホテル ムーンライト
UPDATE hotels SET website = null WHERE id = 19; -- Uno60
UPDATE hotels SET website = null WHERE id = 20; -- ホテル 星
UPDATE hotels SET website = null WHERE id = 21; -- Uno TWINS
UPDATE hotels SET website = null WHERE id = 22; -- ホテル シャイン
UPDATE hotels SET website = 'http://4season.kou.in.net/' WHERE id = 23; -- ホテル 4シーズン
UPDATE hotels SET website = null WHERE id = 24; -- ホテル Pasion
UPDATE hotels SET website = null WHERE id = 25; -- セラファイブ
UPDATE hotels SET website = null WHERE id = 26; -- Uno
UPDATE hotels SET website = 'http://www.hotel-joy.com' WHERE id = 27; -- HOTEL JOY
