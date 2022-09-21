<?php
session_start();
require_once 'connect.php';

$category = $_REQUEST['note-category'];
$name = $_REQUEST['note-name'];
$text = $_REQUEST['note-text'];
$date = date("Y/m/d h:i");
$key = md5(time());



$sql = "INSERT INTO note (category, content, date, name, secret_key) VALUES ";
$sql .= "('" . $category . "',";
$sql .= "'" . $text . "',";
$sql .=  "'" . $date . "',";
$sql .=  "'" . $name . "',";
$sql .= "'" . $key . "')";


//print $sql;
if(mysqli_query($link, $sql)){
    print ("Stored");
} else {
    print("Failed");
}
$_SESSION['note-key'] = $key;
echo "<script>location.href='index.php'</script>";
?>
