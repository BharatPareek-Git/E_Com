<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	include_once("../partials-front-end/header-menu.php");
?>

<?php
	// Product delete status
	if(isset($_SESSION['delete-product-status']))
	{
		echo $_SESSION['delete-product-status'];
		//unset($_SESSION['delete-product-status']);
	}
	// Product update status
	if(isset($_SESSION['update-product-status']))
	{
		echo $_SESSION['update-product-status'];
		//unset($_SESSION['update-product-status']);
	}
	// Product image delete status
	if(isset($_SESSION['delete-product-img-status']))
	{
		echo $_SESSION['delete-product-img-status'];
		//unset($_SESSION['delete-product-img-status']);
	}

	// Product show status
	if(isset($_SESSION['product-show-status']))
	{
		echo $_SESSION['product-show-status'];
		unset($_SESSION['product-show-status']);
	}
?>

<div class="product-div-display">
	<div class="product-div-Display-main">
		<h2 class="m-2 mt-4">All Product</h2>
		<table class="table table-bordered m-2 ">
  			<thead>
  		  	  	<tr>
  		    	  	<th>Id</th>
  		    	  	<th>Title</th>
  		    	  	<th>Product Image</th>
  		    	  	<th>Category</th>
  		    	  	<th>Price</th>
  		    	  	<th>Quantity</th>
  		    	  	<th colspan="2">Action</th>
  		  		</tr>
  			</thead>
  			<tbody>
  				<?php 
  					// Get data from DB 
  					// SQL Query
  					$sql = "select * from tbl_products";
  					// Execute SQL Query
  					$res = mysqli_query($conn,$sql);
  					// Count Rows
  					$count = mysqli_num_rows($res); 
  					if($count > 0)
  					{
  						// Query Executed
  						while($row=mysqli_fetch_assoc($res))
  						{
  							$id = $row['product_id'];
  							$title = $row['product_title'];
  							$image = $row['product_image'];
  							$category_id = $row['product_cat_id'];
  							$price = $row['product_price'];
  							$quantity = $row['product_quantity'];
  							?>
  							<tr>
  		    					<td><?php echo $id; ?></td>
  		    	  				<td><?php echo $title; ?></td>
  		    	  				<td>
  		    	  					<img src="<?php echo SITEURL; ?>images/product_images/<?php echo $image; ?>" width="10%">
  		    	  				</td>
  		    	  				<td><?php echo $category_id; ?></td>
  		    	  				<td><?php echo $price; ?></td>
  		    	  				<td><?php echo $quantity; ?></td>
  		    	  				<td>
  		    	  					<a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>">
  		    	  						<i class="fa-solid fa-square-pen fa-2xl" style="color: #3170dd;"></i>
  		    	  					</a>
  		    	  				</td>
  		    	  				<td>
  		    	  					<a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>">
  		    	  						<i class="fa-sharp fa-solid fa-delete-left fa-2xl" style="color: #e62b0f;"></i>
  		    	  					</a>
  		    	  				</td>
  		  					</tr>

  							<?php
  						}
  						?>
  				</tbody>
			</table>
						<?php
							// unset 
							// Check delete-product-status and delete-product-img-status and unset because data is availble for display
  							if(isset($_SESSION['delete-product-status']))
							{
								unset($_SESSION['delete-product-status']);
							}
					
							// Product image delete status
							if(isset($_SESSION['delete-product-img-status']))
							{
								unset($_SESSION['delete-product-img-status']);
							}

							// Product update status
							if(isset($_SESSION['update-product-status']))
							{
								unset($_SESSION['update-product-status']);
							}
  					}
  					else
  					{
  						// Query is not Executed means products are not added
  						// Error message and 
  						// Redirect to view-product page so error message will display
  						$_SESSION['product-show-status'] = "<div class='error text-center'>Products not found Please add product first</div>";
  						// Redirect using js
  						?>

  						<script type="text/javascript">
  							window.location.href='<?php echo SITEURL; ?>admin/add-product.php';
						</script>

  						<?php
  					}
  				?>
	</div>
</div>

<!-- Footer part include -->
<?php 
	include_once("../partials-front-end/footer.php");
?>