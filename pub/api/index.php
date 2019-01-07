<?php
include_once '../../sys/init.php';

$res = FacePP::search($groupname, $_FILES["file"]["tmp_name"]);

echo json_encode($res);
