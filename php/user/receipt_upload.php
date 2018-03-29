<?php
	require '../actions/conn.php';
	require '../actions/src/main.php';
	
	
	#insert into db when picture is available
	function insert_into_db($options = array(),$post_data = array()){
		extract($options);
		extract($post_data);
		require '../actions/conn.php';
		$date = date("Y:m:d");
		$query = "UPDATE `Expense` SET `receipt_status`='Available',`date_approved`='$date' WHERE `expense_id`='$expense_id';";
		$query .= "INSERT INTO `Receipts`(`user_id`, `expense_id`, `team_id`, `image_path`, `date_posted`) VALUES ('$user_id','$expense_id','$team_id','$url','$date');";
		if(mysqli_multi_query($link,$query)){
			echo "Receipt Upload successful, Redirecting..";
			header("refresh:2;url=http://localhost/Xpense/php/user/receipts.php");
		}else{
			echo "Something Went Wrong, Try Again";
			header("refresh:2;url=http://localhost/Xpense/php/user/receipts.php");
		}
	}
	
	#upload to cloudinary
	function create_photo( $file_path)
	{
		$result = \Cloudinary\Uploader::upload($file_path, array(
			"tags" => "XpenseHub",
		));
		
		unlink($file_path);
		error_log("Upload result: " . \Xpensehub\ret_var_dump($result));
		
		insert_into_db($result,$_POST);
		return $result;
	}
	#collate submitted input
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$files = $_FILES["files"];
		$files = is_array($files) ? $files : array( $files );
		foreach ($files["tmp_name"] as $index => $value) {
			if($value != ""){
				create_photo($value);
			}else{
				echo "Please Attach an Image and Try Again";
			}
		}
	}
?>
