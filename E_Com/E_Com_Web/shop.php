<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>
		<!-- All Product  -->
		<section class="container p-4">
  	 		<div class="container-80">
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
			</div>
  	 	</section>

<!-- Include Footer Section -->
<?php 
	include_once("partials-user-front-end/user-footer.php")
?>