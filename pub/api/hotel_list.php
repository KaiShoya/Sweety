<?php
include_once '../../sys/init.php';

$hotels = new HotelsMapper();
$hotels_list = $hotels::all();

echo json_encode($hotels_list);
