 <!-- Check user is logged in or not this header file is included in every admin pannel page so that's why i here include this page -->
<?php 
	include_once("admin-login-authentication-check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy Shop</title>
	<!-- CSS File -->
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">

	<!-- Bootstrup link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  	<!-- Font Asesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  	<!-- CSS File -->
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">
</head>
<body>
	<!-- Nav Bar -->
	<section class="admin-nav-bar">
		<ul>
			<li class="list-style-remove">
				<a href="<?php echo SITEURL; ?>admin/" class="bold text-decoration-remove hover-grey">Easy Shop</a>
			</li>
			<li class="list-style-remove pull-right">
				<div class="dropdown">
  					<button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1"data-bs-toggle="dropdown" aria-expanded="false" class="default-color">
  						<i class="fa-solid fa-user" style="color: #b7c4e6;"></i>
  						<?php echo $_COOKIE['username']; ?>	
  					</button>
  					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    					<li><a class="dropdown-item" href="<?php echo SITEURL; ?>admin/admin-logout.php">
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
	<section class="admin-dashboard">
		<div class="left-dashboard">
			<!-- Options Table Start -->
			<table class="table text-white table-borderless table-hover">
  				<thead>
  					<tr class="bg-dark">
  						<td>
  							<a href="<?php echo SITEURL; ?>admin/" class="text-decoration-remove">
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
  							<a href="<?php echo SITEURL; ?>admin/orders.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-gauge" style="color: #e6ebf4;"></i>
  									Orders
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>admin/view-products.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-square-poll-vertical" style="color: #e6ebf4;"></i>
  									View Products
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>admin/add-product.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-border-all" style="color: #dae1ec;"></i>
  									Add Products
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>admin/categories.php" class="text-decoration-remove">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-display" style="color: #f2f2f3;"></i>
  									Category
  								</div>
  							</a>
  						</td>
  					</tr>
  					<tr>
  						<td>
  							<a href="<?php echo SITEURL; ?>admin/users.php" class="text-decoration-remove mt-2">
  								<div class="div-color-hover">
  									<i class="fa-solid fa-user-gear" style="color: #e6ebf4;"></i>
  									Users
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