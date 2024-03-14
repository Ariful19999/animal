<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'animal_db');

// define('HOST', 'localhost');
// define('USER', 'deshdgfg_rps');
// define('PASS', '_?)D+Kx5~,a[');
// define('DB', 'deshdgfg_vdb');

$con = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');
