
<?php

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
//nom bd: heroku_c39c98ebe5f07fd (s'agafa automaticament)
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB



$bd = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$bd->set_charset("utf8");

if (mysqli_connect_errno()) {
 
    echo 'Failed to connect!';
    exit();
}

?>