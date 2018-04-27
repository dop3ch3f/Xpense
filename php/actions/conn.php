<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "id4885341_xpense_hub";

$link = mysqli_connect($servername,$username,$password,$db);

if (!($link)) {
  die("Connection Failed:".mysqli_connect_error());
}
?>