ftp -pn << EOF
open shoya85.starfree.jp
user shoya85.starfree.jp anua10fweoi32
# debug
bin
mkdir -f sys/
mput sys/*
mkdir -f pub/
mput pub/*
mkdir -f logs/
quit
EOF
