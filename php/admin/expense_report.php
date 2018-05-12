
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>
		Receipts
	</title>
	<link href='../../css/materialize.min.css' rel="stylesheet" />
	<link href='../../css/styles.css' rel="stylesheet" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
	<script src='../../js/jquery-3.3.1.min.js'></script>
	<script src='../../js/materialize.min.js'></script>
	<style>
		body {
			background: linear-gradient(to right,#c33764,#1d2671);
			color: whitesmoke !important;
		}
		a {
			color:whitesmoke !important;
		}
		nav {
			background: transparent !important;
			border: none;
		}
		.card-panel a h6,.card-panel a i {
			color: #2c3e50 !important;
		}
		.collapsible-header,.collapsible-body, .prefix {
			color: #2c3e50 !important;
		}
		.prefix {
			font-size: 1.5em !important;
		}
		.collapsible-body, .dateform{
			background-color: whitesmoke;
		}
	</style>
</head>

<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo center">Expense Report</a>
        <ul id="nav-mobile" class="left">
            <li>
                <a  class="btn purple  show-on-large" href="./main.php">
                    Back to Home
                </a>
            </li>
        </ul>
    </div>
</nav>
<br/>
<br/>
<div class="container">
	<div class="row">
		<div class="col s12">
			<table class="responsive-table highlight">
				<?php
					require "../actions/conn.php";
					
					function pending($f,$t,$tid,$link){
						$query = "SELECT * FROM `user_expense` WHERE `team_id` = '$tid' AND `status` = 'Pending' AND `date_created` >= DATE_FORMAT('$f','%Y-%m-%d') AND `date_created` <= DATE_FORMAT('$t','%Y-%m-%d')";
						$result = mysqli_query($link, $query);
						echo "<thead>
                                <tr>
                                  <th>Member</th>
                                  <th>Item Name</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Date</th>
                                </tr>
                               </thead><tbody>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>
                                     <td>".$row['full_name']."</td>
                                     <td>".$row['name']."</td>
                                     <td>".$row['price']."</td>
                                     <td>".$row['description']."</td>
                                     <td>".$row['status']."</td>
                                     <td>".$row['date_created']."</td>
                                 </tr>";
					}
					          echo "</tbody>";
					}
					function accepted($f,$t,$tid,$link){
						$query = "SELECT * FROM `user_expense` WHERE `team_id` = '$tid' AND `status` = 'Approved' AND `date_approved` >= DATE_FORMAT('$f','%Y-%m-%d') AND `date_approved` <= DATE_FORMAT('$t','%Y-%m-%d') ";
						$result = mysqli_query($link, $query);
						echo "<thead>
                                <tr>
                                  <th>Member</th>
                                  <th>Item Name</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Date</th>
                                </tr>
                               </thead><tbody>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>
                                     <td>".$row['full_name']."</td>
                                     <td>".$row['name']."</td>
                                     <td>".$row['price']."</td>
                                     <td>".$row['description']."</td>
                                     <td>".$row['status']."</td>
                                     <td>".$row['date_created']."</td>
                                 </tr>";
						}
						echo "</tbody>";
					}
					function rejected($f,$t,$tid,$link){
						$query = "SELECT * FROM `user_expense` WHERE `team_id` = '$tid' AND `status` = 'Declined' AND `date_created` >= DATE_FORMAT('$f','%Y-%m-%d') AND `date_created` <= DATE_FORMAT('$t','%Y-%m-%d')";
						$result = mysqli_query($link, $query);
						echo "<thead>
                                <tr>
                                  <th>Member</th>
                                  <th>Item Name</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Date</th>
                                </tr>
                               </thead><tbody>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>
                                     <td>".$row['full_name']."</td>
                                     <td>".$row['name']."</td>
                                     <td>".$row['price']."</td>
                                     <td>".$row['description']."</td>
                                     <td>".$row['status']."</td>
                                     <td>".$row['date_created']."</td>
                                 </tr>";
						}
						echo "</tbody>";
					}
					function complete($f,$t,$tid,$link){
						$query = "SELECT * FROM `user_expense` WHERE `team_id` = '$tid' AND `receipt_status` = 'Available' AND `date_created` >= DATE_FORMAT('$f','%Y-%m-%d') AND `date_created` <= DATE_FORMAT('$t','%Y-%m-%d')";
						$result = mysqli_query($link, $query);
						echo "<thead>
                                <tr>
                                  <th>Member</th>
                                  <th>Item Name</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Date</th>
                                </tr>
                               </thead><tbody>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>
                                     <td>".$row['full_name']."</td>
                                     <td>".$row['name']."</td>
                                     <td>".$row['price']."</td>
                                     <td>".$row['description']."</td>
                                     <td>".$row['status']."</td>
                                     <td>".$row['date_created']."</td>
                                 </tr>";
						}
						echo "</tbody>";
					}
					function receipt($f,$t,$tid,$link){
						$query = "SELECT * FROM `admin_receipt` WHERE `team_id` = '$tid' AND `rpt_status` = 'Pending' AND `date_posted` >= DATE_FORMAT('$f','%Y-%m-%d') AND `date_posted` <= DATE_FORMAT('$t','%Y-%m-%d')";
						$result = mysqli_query($link, $query);
						echo "<thead>
                                <tr>
                                  <th>Receipt Image</th>
                                  <th>Member</th>
                                  <th>Item Name</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Date</th>
                                </tr>
                               </thead><tbody>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>
                                     <td><img src='".$row['image_path']."' width='100px' height='100px' alt='image here' /> </td>
                                     <td>".$row['full_name']."</td>
                                     <td>".$row['name']."</td>
                                     <td>".$row['price']."</td>
                                     <td>".$row['description']."</td>
                                     <td>".$row['rpt_status']."</td>
                                     <td>".$row['date_posted']."</td>
                                 </tr>";
						}
						echo "</tbody>".mysqli_error($link);
					}
					
					if($_SERVER["REQUEST_METHOD"]== "POST"){
						extract($_POST);
						switch($type){
							case 'pending':
								pending($from,$to,$team_id,$link);
								break;
							case 'accepted':
								accepted($from,$to,$team_id,$link);
								break;
							case 'rejected':
								rejected($from, $to,$team_id,$link);
								break;
							case 'complete':
								complete($from,$to,$team_id,$link);
								break;
							case 'receipt':
								receipt($from, $to,$team_id,$link);
								break;
							default:
						}
					}
					mysqli_close($link);
				?>
			</table>
		</div>
	</div>
</div>
</body>


</html>