<!-- Include constants for DB  -->
<?php 
	include_once("config/constants.php");
?>
<!-- Include user Authentication file -->
<?php 
	include_once("user-authenication-check.php");
?>
<?php
	// Fetch Data
	// SQL Query
	$username = $_COOKIE['user-success-login'];
	$sql_user_info = "select * from user where username='$username'";
	// Execute SQL Query
	$res_user_info = mysqli_query($conn,$sql_user_info);
	// Count available rows 
	$count_user_info = mysqli_num_rows($res_user_info);
	// Check Data found or not
	// Details stored in varilables and decalration of variables
	$user_img_logo = "";
	if($count_user_info == 1)
	{
		// vaild user and data found
		$row_user_imfo = mysqli_fetch_assoc($res_user_info);
		$user_img_logo = $row_user_imfo['profile_picture'];

		// Check profile picture is empty or not
		if($user_img_logo == "")
		{
			// profile picture is empty and assign default image to profile picture
			$user_img_logo = "guest-img-logo.jpg";
		}
	}  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Dashboard</title>
	<!-- Bootstrup link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  	<!-- Font Asesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  	<!-- CSS File -->
	<link rel="stylesheet" type="text/css" href="css/user-dashboard-style.css">
</head>
<body>
	<!-- Nav Bar -->
	<section class="user-nav-bar">
		<ul>
			<li class="list-style-remove">
				<a href="#" class="bold text-decoration-remove hover-grey">
					<img src="images/web-images/user-default/<?php echo $user_img_logo; ?>" class="rounded-circle" width="40px">
				</a>
			</li>
			<li class="list-style-remove pull-right">
				<div class="dropdown">
  					<button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1"data-bs-toggle="dropdown" aria-expanded="false" class="default-color">
  						<i class="fa-solid fa-user" style="color: #b7c4e6;"></i>
  							<?php echo $username; ?>
  					</button>
  					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    					<li><a class="dropdown-item" href="<?php echo SITEURL; ?>user-logout.php">
    							<i class="fa-solid fa-power-off" style="color: #3b71ce;"></i>
    							Log Out
    						</a>
    					</li>
 					 </ul>
				</div>
			</li>
		</ul>
	</section>
	<!-- Nav Bar End -->

	<!-- Dashboard Start-->
	<section class="user-dashboard">
		<div class="left-dashboard">
			<!-- Options Table Start -->
			<table class="table text-white table-borderless table-hover">
  				<thead>
  					<tr class="bg-dark">
  						<td>
  							<a href="<?php echo SITEURL; ?>user-dashboard.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-gauge" style="color: #e6ebf4;"></i>
  									Dashboard
  								</div>
  							</a>
  						</td>
  					</tr>
  				</thead> 
  				<tbody>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-house" style="color: #e8eaee;"></i>
  									Home
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>user-profile.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-square-poll-vertical" style="color: #e6ebf4;"></i>
  									Your Profile
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>orders.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-border-all" style="color: #dae1ec;"></i>
  									Orders
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="#" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-display" style="color: #f2f2f3;"></i>
  									Reviews
  								</div>
  							</a>
  						</td>
  					</tr>
  				</tbody>
			</table>
			<!-- Option Table End -->
		</div>
		<div class="right-dashboard">
			<div class="page-header">
				<h2 class="dashboard-heading">Dashboard </h2><small class="color-grey">Statistics Overview</small> 
				<hr class="color-grey">
			</div>

			<div class="dashboard-div">
				<div class="dashboard-color">
					<i class="fa-solid fa-gauge"></i>
					Dashboard
				</div>