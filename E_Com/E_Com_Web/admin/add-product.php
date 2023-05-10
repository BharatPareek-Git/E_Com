<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	include_once("../partials-front-end/header-menu.php");
?>

<?php 
	// Product upload status
	if(isset($_SESSION['product-upload-status']))
	{
		echo $_SESSION['product-upload-status'];
		unset($_SESSION['product-upload-status']);
	}

	// Product show status when products are not found and redirect for add-product
	if(isset($_SESSION['product-show-status']))
	{
		echo $_SESSION['product-show-status'];
		unset($_SESSION['product-show-status']);
	}

	// Delete Product status when we delete data product
	if(isset($_SESSION['delete-product-status']))
	{
		echo $_SESSION['delete-product-status'];
		unset($_SESSION['delete-product-status']);
	}

	// Delete Product image error (if image not deleted) status when we delete data product
	if(isset($_SESSION['delete-product-img-status']))
	{
		echo $_SESSION['delete-product-img-status'];
		unset($_SESSION['delete-product-img-status']);
	}

	// Product update status
	if(isset($_SESSION['update-product-status']))
	{
		echo $_SESSION['update-product-status'];
		unset($_SESSION['update-product-status']);
	}

?>

<!-- Form Start -->
	<section class="product-div">
		<div class="product-div-form">
			<h2>Add Product</h2>
			<form action="" method="post" enctype="multipart/form-data">
  				<div class="mb-3">
    				<label for="product-name" class="form-label">Title</label>
    				<input type="text" class="form-control" id="product-name" name="product-title" required>
    				<label for="product-short-description" class="form-label">Product Short Description</label>
    				<textarea class="form-control" id="product-short-description" name="product-short-description" required rows="3"></textarea>
    				<label for="product-full-description" class="form-label">Product Description</label>
    				<textarea class="form-control" id="product-full-description" name="product-full-description" required rows="5"></textarea>
    				<label for="select-category" class="form-label">Product Category</label>
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
    							?>
    							<option value="0">Select Category</option>
  								<?php
  								// <option value="1">Laptop</option>
  								while($row = mysqli_fetch_assoc($res))
  								{
  									// Fetch data form DB
  									$cat_id = $row['cat_id'];
  									$cat_title = $row['cat_title'];
  									// Display Category
  									?>
  									<option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
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
					<label for="product-price" class="form-label">Product Price</label>
    				<input type="number" class="form-control" id="product-price" name="product-price" min="1" required>
    				<label for="product-quantity" class="form-label">Product Quantity</label>
    				<input type="number" class="form-control" id="product-quantity" name="product-quantity" min="1" required>
    				<label for="product-image" class="form-label">Product Image</label>
    				<input type="file" class="form-control" id="product-image" name="product-image" required>
    			</div>
    			
    		
  				<input type="submit" class="btn btn-primary" value="Add Product" name="submit">
			</form>
		</div>
	</section>
	<!-- Form End -->

<?php 
	// Check Whether Submit Button is clicked or not
	if(isset($_POST['submit']))
	{
		// Button is clicked
		// GET Data from Form

		$product_title = $_POST['product-title'];
		$product_short_description = $_POST['product-short-description'];
		$product_description = $_POST['product-full-description'];
		$product_price = $_POST['product-price'];
		$product_quantity = $_POST['product-quantity'];
		$product_cat_id = $_POST['product-cat-id'];
		$product_image = "";
		// Check image is selected or not
		if($_FILES['product-image']['name'])
		{
			// image is selected 
			$product_image = $_FILES['product-image']['name'];

			// now upload image
			$source_path = $_FILES['product-image']['tmp_name'];
			$destination_path = "../images/product_images/".$product_image;

			// Upload image 
			$upload = move_uploaded_file($source_path,$destination_path);// returns 1 if image or file is successfully uploaded

			// check image is successfully uploaded or not
			if($upload == false)
			{
				// image is not uploaded
				// show an error message 
				$_SESSION['product-upload-status'] = "<div class='error text-center'>Something went wrong with image</div>";
				// redirect using JS to add-product.php
				?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>admin/add-product.php';
				</script>

				<?php
				// die code using die() method
				die();
			}

		}
		// Here image contains required attribute, so image not selected and submit button is clicked not possible 

		// SQL Query to upload Data on DB
		$sql2 = "insert into tbl_products (product_title,product_cat_id,product_price,product_quantity,product_short_description,product_description,product_image) values('$product_title',$product_cat_id,$product_price,$product_quantity,'$product_short_description','$product_description','$product_image')";

		// Execute SQL Query
		$res2 = mysqli_query($conn,$sql2);
		// Check Query is Executed or not

		if($res2 == TRUE)
		{
			// Query is executed and data successfully inserted into DB
			// Success message display and redirect to same page
			$_SESSION['product-upload-status'] = "<div class='success text-center'>Product Successfully Insert</div>";

			//Redirect using JS
			?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/add-product.php';
			</script>
			<?php
		}
		else
		{
			// Query is not executed and data is not inserted into DB
			// Success message display and redirect to same page
			$_SESSION['product-upload-status'] = "<div class='error text-center'>Something went wrong and Product not Inserted</div>";

			//Redirect using JS
			?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/add-product.php';
			</script>
			<?php
		}
	}
?>

<!-- Footer part include -->
<?php 
	include_once("../partials-front-end/footer.php");
?>