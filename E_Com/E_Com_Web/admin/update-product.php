<!-- include constants so DB and constant are used -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	include_once("../partials-front-end/header-menu.php");
	// Create form to add category 
?> 
<?php 
	if(isset($_GET['id']))
	{
		// Id is set
		// Get All Data From DB 
		$id = $_GET['id'];
		$sql = "select * from tbl_products where product_id=$id";
		// Execute the query
		$res = mysqli_query($conn,$sql);
		// Count num rows
		$count = mysqli_num_rows($res);

		// Fetch data
		if($count == 1)
		{
			$row = mysqli_fetch_assoc($res);
			$product_title = $row['product_title'];
			$product_cat_id = $row['product_cat_id'];
			$product_price = $row['product_price'];
			$product_quantity = $row['product_quantity'];
			$product_short_description = $row['product_short_description'];
			$product_description = $row['product_description'];
			$product_image_old = $row['product_image'];

			// Form where old data show and option to update data
			?>

				<!-- Update Form Start -->
				<section class="product-div">
					<div class="product-div-form">
						<h2>Product Update</h2>
						<form action="" method="post" enctype="multipart/form-data">
  							<div class="mb-3">
  								<label for="product-id" class="form-label">Id</label>
    							<input type="text" class="form-control" id="product-id" name="product-id" requried readonly value="<?php echo $id; ?>">
    							<label for="product-title" class="form-label">Title</label>
    							<input type="text" class="form-control" id="product-title" name="product-title" requried value="<?php echo $product_title; ?>">
    							<label for="product-price" class="form-label">Price</label>
    							<input requried type="number" class="form-control" id="product-price" name="product-price" min="1" value="<?php echo $product_price; ?>">
    							<label for="select-category" class="form-label">Select Category</label>
    							<select class="form-select" id="select-category" name="product-cat-id" required>
    								<?php 
    									// Fetch Categories and category id
    									// SQL Query
    									$sql = "select * from tbl_categories";
    									//Execute SQL Query
    									$res = mysqli_query($conn,$sql);
    									// Count Rows to check whether we have data or not 
    									$count = mysqli_num_rows($res);

    									if($count > 0)
    									{
    										// Data is Available
  											// <option value="1">Laptop</option>
  											while($row = mysqli_fetch_assoc($res))
  											{
  												// Fetch data form DB
  												$cat_id = $row['cat_id'];
  												$cat_title = $row['cat_title'];
  												// Display Category
  												?>
  												// also compare with DB cat_id if match found then select
  												<option <?php if($cat_id==$product_cat_id){echo "selected";} ?> value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
  												<?php
  											}
    									} 
    									else
    									{
    										// Data is Not Available
    										?>
    										<option value="0">No Category Found</option>
    										<?php
    									}
    								?>
								</select>
    						    <label for="product-quantity" class="form-label">Product Quantity</label>
    							<input requried type="number" class="form-control" id="product-quantity" name="product-quantity"value="<?php echo $product_quantity; ?>">
    							<label for="product-short-description" class="form-label">Product Short Description</label>
    							<textarea requried rows="3" class="form-control" id="product-short-description" name="product-short-description"> <?php echo $product_short_description; ?> </textarea>
  								<label for="product-full-description" class="form-label">Product full Description</label>
    							<textarea requried rows="5" class="form-control" id="product-full-description" name="product-description"><?php echo $product_description; ?></textarea>
    							<?php 
    								// Cheeck image is exists or not
    								if(!($product_image_old == ""))
    								{
    									// Image Exist so display
    									?>	
    									<img src="../images/product_images/<?php echo $product_image_old;  ?>" width="5%" alt="product-image" class="p-2">
    									<br>
    									<?php
    								}
    								else
    								{
    									echo "<p class='error'>Image not Found</p>";
    								}
    							?>
    							<label for="product-image-new" class="form-label">Select new Product Image</label>
    							<input type="file" class="form-control" id="product-image-new" name="product-image-new">
    					 	</div>
    					 	<input type="hidden" name="img-old" value="<?php echo $product_image_old; ?>">
  							<input type="submit" class="btn btn-primary" value="Update Product" name="submit">
						</form>
					</div>
				</section>
				<!--Update Form End -->
							   <?php
		}
	}
	else
	{
		// Id is not set
		// Error message and redirect to 
		$_SESSION['update-product-status'] = "<div class='error text-center'>Something went wrong Id not set</div>";
		// Redirect to view-category.php page
		?>

		<script type="text/javascript">
			window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
		</script>

		<?php
	}
?>

<?php
	// Update Data
	if(isset($_POST['submit']))
	{
		// Submit Button is clicked;
		// GET Data from form 
		$product_id = $_POST['product-id'];
		$product_title = $_POST['product-title'];
		$product_price = $_POST['product-price'];
		$product_category_id = $_POST['product-cat-id'];
		$product_quantity = $_POST['product-quantity'];
		$product_short_description = $_POST['product-short-description'];
		$product_description = $_POST['product-description'];
		$img_name_old = "";
		$img_name_new = "";
		$img_name_old = $_POST['img-old'];
		$img_name_new = $_FILES['product-image-new']['name'];

		// Check new image is empty or having something
		if($img_name_new == "")
		{
			// Image is not selected and need to use old image 
			$img_name_new = $img_name_old;
		}
		else
		{
			// need to delete first old image 
			$img_delete_path = "../images/product_images/".$img_name_old;
			$img_remove_status = unlink($img_delete_path);

			// check any error while deleting an image 
			if($img_remove_status == false)
			{
				$_SESSION['update-product-status'] = "<div class='error text-center'>Something went wrong Image not deleted</div>";

				// Redirect and show an error message
				?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
				</script>
				<?php
				die();
			}
			else
			{
				// Upload selected Image
				$source_path = $_FILES['product-image-new']['tmp_name'];
				$destination_path = "../images/product_images/".$img_name_new;
				$upload_new_img = move_uploaded_file($source_path,$destination_path);// returns 1 if image or file is successfully uploaded
				// Now check for image is uploaded or not
				if($upload_new_img == false)
				{
					// image is not uploaded
					// show an error message 
					$_SESSION['update-product-status'] = "<div class='error text-center'>Something went wrong with image (not uploaded new image)</div>";
					// redirect using JS to add-product.php
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
						</script>

					<?php
						// die code using die() method
						die();
				}
			}

		}	
		// Now Update DB
		// SQL Query for update
		$sql_update = "update tbl_products set product_title='$product_title',product_cat_id=$product_category_id,product_price=$product_price,product_quantity=$product_quantity,product_short_description='$product_short_description',product_description='$product_description',product_image='$img_name_new' where product_id=$product_id";
		// Execute SQL Query
		$res_update = mysqli_query($conn,$sql_update);
		// Check Query is successfully executed or not
		if($res_update == TRUE)
		{ 
			// Query is executed
			if(mysqli_affected_rows($conn))
			{
				// not updated 
				// error message and redirect
				$_SESSION['update-product-status'] = "<div class='success text-center'>Product Successfully Updated</div>";
				// redirect using JS to add-product.php
				?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
					</script>

				<?php
			}
			else
			{
				$_SESSION['update-product-status'] = "<div class='error text-center'>Something went wrong with product_id data is not Updated</div>";
				// redirect using JS to add-product.php
				?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
					</script>

				<?php
			}
		}
		else
		{
			$_SESSION['update-product-status'] = "<div class='error text-center'>Something went wrong with Query data is not Updated</div>";
			// redirect using JS to add-product.php
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
				</script>
			<?php
		}	
		
 	}
