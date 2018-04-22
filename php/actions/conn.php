<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "id4885341_xpense_hub";

$link = mysqli_connect($servername,$username,$password,$db);

$host_address="http://localhost/";

$root_folder="xpensehub/";

$mailendpoint="php/actions/register?admin=";




if (!($link)) {
  die("Connection Failed:".mysqli_connect_error());
}
?>