<!-- include constants for DB and Constants -->
<?php 
	include_once("config/constants.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy Shop</title>
	<!-- CSS File Include -->
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- Bootstrup link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  	<!-- Font Asesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
	<!-- Navbar Start-->
	<section class="navbar">

		<div class="navbar-container">
			<ul>
				<li class="navbar-list-item">
					<a href="<?php echo SITEURL; ?>">Home</a>
				</li>
				<li class="navbar-list-item">
					<a href="<?php echo SITEURL; ?>shop.php">Shop</a>
				</li>
				<!-- if user is logged in then sign in an log in option not need to display -->
				<!-- Both Options only display when user is not authenticated -->
				<!-- Check user is logged in or not -->
				<?php 
					if(!isset($_COOKIE['user-success-login']))
					{
						// User is not Logged in so need to display both Login and sign in option
						?>
							<li class="navbar-list-item">
								<a href="<?php echo SITEURL; ?>user-login.php">Login</a>
							</li>
							<li class="navbar-list-item">
								<a href="<?php echo SITEURL; ?>user-create-account.php">Sign Up</a>
							</li>
						<?php
					}
				?>
				
				<li class="navbar-list-item">
					<a href="<?php echo SITEURL; ?>admin">Admin</a>
				</li>
				<li class="navbar-list-item">
					<a href="<?php echo SITEURL; ?>checkout.php">Checkout</a>
				</li>
				<li class="navbar-list-item">
					<a href="<?php echo SITEURL; ?>">Contact</a>
				</li>
				<li class="navbar-list-item">
					<!-- <input type="text" name="search" class="search">
					<input type="submit" name="submit" class="search"> -->
  						<input type="text" name="seach" placeholder="  Search  " aria-label="Search" aria-describedby="search-addon">
  						<a href="<?php echo SITEURL; ?>">
  							<span>
    							<i class="fa-solid fa-magnifying-glass"></i>
  							</span>
  						</a>	
				</li>
				<li class="navbar-list-item">
					<a href="<?php echo SITEURL; ?>checkout.php">
						<span class="text-white">
							<i class="fa-solid fa-cart-shopping" style="color: #eef3fb;"></i>
							<?php 
								// Check cart cookies are set or not
								if(isset($_COOKIE['user-add-to-cart-cookie']))
								{
									// decode array from json string object which is store in cookie
									$productArray = json_decode($_COOKIE['user-add-to-cart-cookie'],true);
									echo sizeof($productArray);
								}
								else
								{
									// some time cookies are expire so check user is logged in or not 
									// if user is logged in then data display from DB (Right now this feature is not available)

									// here default data is shown which is 0
									echo "0";
								}
							?>
						</span>
					</a>
				</li>
				<li class="list-style-user-info pull-right">
				<div class="dropdown">
  					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
  						<i class="fa-solid fa-user" style="color: #b7c4e6;"></i>
  						<?php 
  							if(isset($_COOKIE['user-success-login']))
  							{
  								echo $_COOKIE['user-success-login'];
  							}
  							else
  							{
  								echo "Guest";
  							}
  						 ?>	
  					</button>
  					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  						<!-- Options display case 1. user logged in and case 2. not logged in -->
  						<?php 
  							if(isset($_COOKIE['user-success-login']))
  							{
  								// When user is logged in
  								?>
  								<li>
  									<a class="dropdown-item" href="<?php echo SITEURL; ?>user-profile.php">	
    									Your Profile
    								</a>
    							</li>
    							<li>
  									<a class="dropdown-item" href="<?php echo SITEURL; ?>orders.php">	
    									Your Orders
    								</a>
    							</li>
    							<li>
  									<a class="dropdown-item" href="<?php echo SITEURL; ?>#">	
    									Saved items
    								</a>
    							</li>
  								<li>
  									<a class="dropdown-item" href="<?php echo SITEURL; ?>user-logout.php">
    									<i class="fa-solid fa-power-off" style="color: #3b71ce;"></i>	
    									Log out
    								</a>
    							</li>
  								<?php
  							}
  							else
  							{
  								// When user is not logged in 	
  								?>
  									<li>
  										<a class="dropdown-item" href="<?php echo SITEURL; ?>user-login.php">
    										<i class="fa-solid fa-power-off" style="color: #3b71ce;"></i>	
    										Log in
    									</a>
    								</li>
    							<?php
  							}
  						?>
 					 </ul>
				</div>
			</li>
			</ul>
		</div>
	</section>
  	<!-- Navbar End -->
