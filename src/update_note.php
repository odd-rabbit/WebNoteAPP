<?php
session_start();
require_once 'connect.php';

$category = $_REQUEST['note-category'];
$name = $_REQUEST['note-name'];
printf($name);
$text = $_REQUEST['note-text'];
$key = $_REQUEST['note-key'];



$sql = "UPDATE note SET ";
$sql .= "category='" . $category . "', ";
$sql .= "content='" . $text . "', ";
$sql .=  "name='" . $name . "' ";
$sql .= "WHERE secret_key = '" . $key . "'";

//print $sql;
if(mysqli_query($link, $sql)){
    print("Stored");
    $_SESSION['note-update'] = 'success';
} else {
    print("Failed");
    $_SESSION['note-update'] = 'failure';
}

echo "<script>location.href='index.php'</script>";
?>
