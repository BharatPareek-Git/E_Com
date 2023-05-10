<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>	

<!-- Acoount Status -->
<?php 
	// add to cart success or not
	// if(isset($_COOKIE['user-add-to-cart-cookie']))
	// {
	// 	echo $_COOKIE['user-add-to-cart-cookie'];
	// }
	// add to cart status  for error message 
	if(isset($_SESSION['user-add-to-cart-status']))
	{
		echo $_SESSION['user-add-to-cart-status'];
		unset($_SESSION['user-add-to-cart-status']);
	}
	// account creation status
	if(isset($_SESSION['user-account-creation']))
	{
		echo $_SESSION['user-account-creation'];
		unset($_SESSION['user-account-creation']);
	}
	// account login status
    if(isset($_SESSION['user-account-login']))
	{
		echo $_SESSION['user-account-login'];
		unset($_SESSION['user-account-login']);
	}
	// account logout status
    if(isset($_SESSION['user-logout-status']))
	{
		echo $_SESSION['user-logout-status'];
		unset($_SESSION['user-logout-status']);
	}
	// Category Product status
    if(isset($_SESSION['category-product-status']))
	{
		echo $_SESSION['category-product-status'];
		unset($_SESSION['category-product-status']);
	}
	// User data update status 
	
	if(isset($_SESSION['user-profile-update']))
	{
		echo $_SESSION['user-profile-update'];
		unset($_SESSION['user-profile-update']);
	}

	// if without authentication any user try to access user dashboard page 
	if(isset($_SESSION['user-profile-check-authentication']))
	{
		echo $_SESSION['user-profile-check-authentication'];
		unset($_SESSION['user-profile-check-authentication']);
	}
?>

<!-- Carousel Start -->
<div class="carousel">
 	<div id="carouselExampleIndicators" class="carousel slide p-2" data-bs-ride="true">
  		<div class="carousel-indicators">
    		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"aria-current="true" aria-label="Slide 1"></button>
    		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  		</div>
  		<div class="carousel-inner">
    		<div class="carousel-item active">
      			<img src="images/web-images/user_carousel_images/carousel_c1.jpg" width="100%" height="300px" class="d-block w-100" alt="...">
    		</div>
    		<div class="carousel-item">
      			<img src="images/web-images/user_carousel_images/carousel_c2.jpg" width="100%" height="300px" class="d-block w-100" alt="...">
    		</div>
    		<div class="carousel-item">
      			<img src="images/web-images/user_carousel_images/carousel_c3.jpg" width="100%" height="300px"class="d-block w-100" alt="...">
    		</div>
  		</div>
  		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    		<span class="visually-hidden">Previous</span>
  		</button>
  		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    		<span class="carousel-control-next-icon" aria-hidden="true"></span>
    		<span class="visually-hidden">Next</span>
  		</button>
	</div>
</div>
<!-- Carousel End -->

		<!-- Categories and Product Quickview -->
  	 	<section class="container p-4">
  	 		<div class="container-80">
  	 			<div class="main-content-table"> 
  					<h5 class="p-2">Category</h5>      
  					<table class="table table-hover table-bordered">
    					<tbody>
    						<?php 
    							// Fetch Data from DB
    							$sql_category = "select * from tbl_categories";
    							// Execute SQL Query
    							$res_catgory = mysqli_query($conn,$sql_category);
    							// Check Whether We have categories to display or not
    							$count_category = mysqli_num_rows($res_catgory);
    							// Check count is greate zero 
    							if($count_category > 0)
    							{
    								// We have categories 
    								// Display category data
    								while($row_category=mysqli_fetch_assoc($res_catgory))
    								{
    									?>
    										<tr>
    											<td>
    												<a href="<?php echo SITEURL; ?>category-products.php?id=<?php echo $row_category['cat_id']; ?>" class="tbl-a-style-remove">
    													<?php echo $row_category['cat_title']; ?>
    												</a>
    											</td>	
        									</tr>
    									<?php
    								}
    								
    							}
    							else
    							{
    								// We not have category
    								echo "<tr><td class='error text-center'>Categories not found</td></tr>";
    							}
    						?>
   						</tbody>
  					</table>
  				</div>

  				<!-- Products -->
  				<div class="grid-container">
  					<?php 
  						// Fetch Product
  						$sql_product = "select * from tbl_products where product_quantity>0 limit 9";
  						// Execute SQL Query
  						$res_product = mysqli_query($conn,$sql_product);
  						// Count products
  						$count_product = mysqli_num_rows($res_product);
  						// Check Products are available or not
  						if($count_product > 0)
  						{
  							// Products are available for display
  							while($row_product=mysqli_fetch_assoc($res_product))
  							{
  								?>
  									<div class="container mt-3 grid-item">
  										<div class="card p-1" style="width:100%; min-width: 300px;">
  											<!-- Image Display -->
  											<?php 
  												// Check Whether image is available or not
  												if($row_product['product_image']!="")
  												{
  													// Image is available
  													// Display an image
  													?>
  														<a href="<?php echo SITEURL; ?>product-detail.php?pid=<?php echo $row_product['product_id']; ?>">
  															<img class="card-img-top" src="<?php echo SITEURL; ?>images/product_images/<?php echo $row_product['product_image']; ?>" alt="Card image" style="width:100%">
  														</a>
  													<?php
  												}
  												else
  												{
  													// Image is not availble
  													// Dispaly an error message
  													echo "<p class='error text-center'>Image is not found!</p>";
  												}
  											?>
    										
    										<div class="card-body">
      											<h5 class="card-title text-primary">
      												<a href="<?php echo SITEURL; ?>product-detail.php?pid=<?php echo $row_product['product_id']; ?>" class="text-decoration-remove-a">
      													<?php echo $row_product['product_title']; ?>
      												</a>
      												<span class="pull-right">
      													<a href="#">
      														<i class="fa-regular fa-heart"></i>
      													</a>
      												</span>
      											</h5>
      											<p class="card-text">
      												<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
      												<?php echo $row_product['product_price'] ?>
      											</p>
      											<p class="card-text over-flow">
      												<?php echo $row_product['product_short_description'] ?>
      											</p>
      											<a href="<?php SITEURL; ?>manage-cart.php?pid=<?php echo $row_product['product_id']; ?>" class="btn btn-primary">Add to cart</a>
   											</div>
 										</div>
	  								</div>
  								<?php
  							}
  							
  						}
  						else
  						{
  							// Products are not available
  							echo "<div class='text-center error'>Products are not Found</div>";
  						}
  					?>		
				</div>
  	 	</section>
  	
<!-- Include Footer Section -->
<?php 
	include_once("partials-user-front-end/user-footer.php")
?>
