<?php
$user = 'MYSQL_USER';
$password = 'MYSQL_PASSWORD';
$db = 'notes';
$host = 'mydb';
//$port = 3306;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
//   $port
);

?>
