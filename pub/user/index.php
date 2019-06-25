<?php
include_once '../../sys/init.php';
Context::login_check();

header('Location: ./availability.php', true, 301);
