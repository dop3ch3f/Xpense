<?php
	require "../actions/conn.php";
	require "../actions/server.php";
	ob_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		extract($_POST);
		if($accept){
			$query = "UPDATE `Receipts` SET `receipt_status`='Approved' WHERE `receipt_id`='$accept'";
			if(mysqli_query($link, $query)){
			    echo "Approved, Redirecting ..";
			    header("refresh:3;url=".$server."php/actions/login.php");
			}
		};
		if($decline){
			$query = "UPDATE `Receipts` SET `receipt_status`='Declined' WHERE `receipt_id`='$decline'";
			if(mysqli_query($link, $query)){
				echo "Declined, Redirecting ..";
				header("refresh:3;url=".$server."php/actions/login.php");
			}
		};
	}
	mysqli_close($link);
?>
