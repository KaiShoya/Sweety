# 欲しい機能
## 選択肢
- 曜日
    ボタンで実装？
- 時間帯
    とりあえずセレクトボックス
    何時から利用したいか
- 利用時間
    セレクトボックス
    利用したい時間以上でも安ければ表示する

## 表示
- ホテル名
- 最低料金
- 利用開始
- 利用終了
- 利用時間

# 環境設定
```sh
# Mac
brew install ncftp
# CentOS
sudo yum install -y ncftp
```

# サーバ情報
[StarServerFree](https://secure.netowl.jp/starserver/?action_user_free_index=true)
- FTP
    host: shoya85.starfree.jp
    user: shoya85.starfree.jp
    pass: anua10fweoi32
    - ファイル転送
```
ncftp -u shoya85.starfree.jp shoya85.starfree.jp
anua10fweoi32
put -R pub/
put -R sys/
```

- MySQL
    user: shoya85_root
    pass: sdnvwoqiu3r
