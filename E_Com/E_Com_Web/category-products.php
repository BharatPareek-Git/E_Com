<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>	

<?php 
	// Check Category id is set or not
	if(isset($_GET['id']))
	{
		// Category id is set
		// SQL Query 
		$product_cat_id = $_GET['id'];
		$sql_product_category = "select * from tbl_categories where cat_id=$product_cat_id";
		// Execute SQL Query
		$res_product_cat = mysqli_query($conn,$sql_product_category);
		// Count Rows so we have exact count of availabilty of Products as per their category
		$count_product_category = mysqli_num_rows($res_product_cat);
	?>
		<!-- Categories and Product Quickview -->
  	 	<section class="container p-4">
  	 		<?php
  	 			$category_title_with_id="";
				if($count_product_category == 1)
				{
					// Also Fetch category title
					$row_product_cat_data = mysqli_fetch_assoc($res_product_cat);
					$category_title_with_id = $row_product_cat_data['cat_title'];
					// Category Product status
    				// No of Products in that Category
  	 				echo "<h5 class='text-center success' id='product-title-count-data'>$category_title_with_id</h5>";
   					echo "<hr class='border-color'>";
   				}
				else
				{
					echo "<h4 class='text-center error'>Category not found</h4>";
					echo "<hr class='border-color'>";
				}
  	 				
  	 		?>
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
  						$sql_product = "select * from tbl_products where product_quantity>0 and product_cat_id=$product_cat_id";
  						// Execute SQL Query
  						$res_product = mysqli_query($conn,$sql_product);
  						// Count products
  						$count_product = mysqli_num_rows($res_product);
  						?>
  						<!-- Product Category name with available product count -->
  						<!-- Info display using JS DOM -->
  						<script type="text/javascript">
  							document.getElementById("product-title-count-data").innerHTML="<?php echo $category_title_with_id."<small> ($count_product Products)</small>"; ?>";
  						</script>
  						<?php
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
      											<a href="#" class="btn btn-primary">Add to card</a>
   											</div>
 										</div>
	  								</div>
  								<?php
  							}
  							
  						}
  						// else
  						// {
  						// 	// Products are not available
  						// 	echo "<div class='text-center error'>Products are not Found</div>";
  						// }
  					?>		
				</div>
  	 	</section>
  	<?php
  	}
  	else
	{
		// Category id is not set
		$_SESSION['category-product-status'] = "<div class='error text-center'>Category is not set</div>";
		// Redirect to index.php
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>index.php';
			</script>
		<?php 
	}
?>
<!-- Include Footer Section -->
<?php 
	include_once("partials-user-front-end/user-footer.php")
?>
