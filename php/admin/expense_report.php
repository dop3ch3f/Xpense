<?php
	require "../actions/conn.php";
	
	if($_SERVER["REQUEST_METHOD"]== "POST"){
		extract($_POST);
		switch($type){
			case 'pending':
				break;
			case 'accepted':
				break;
			case 'rejected':
				break;
			case 'complete':
				break;
			case 'receipt':
				break;
			default:
		}
	}
	mysqli_close($link);
?>