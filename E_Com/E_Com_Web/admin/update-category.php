<!-- include constants so DB and constant are used -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	include_once("../partials-front-end/header-menu.php");
	// Create form to add category 
?>
<!-- Fetch Data From DB -->
<?php 
	// Check category_id is selected or not
	if(isset($_GET['category_id']))
	{
		// category_id is set
		// SQL Query
		$category_id = $_GET['category_id'];
		$sql = "select * from tbl_categories where cat_id=$category_id";
		
		// Execute SQL Query
		$res = mysqli_query($conn,$sql);

		// Count Available rows
		$count = mysqli_num_rows($res);

		// Check Data is Available or not
		if($count == 1)
		{
			// Data is available 
			// Fetch Data
			$row = mysqli_fetch_assoc($res);
			$category_title = $row['cat_title'];
			
			//Display Previous Data in form and option for edit and update
			?>

			<!-- Update Form Start -->
			<section class="category-div">
				<div class="category-div-form">
					<h2>Product Categories</h2>
					<form action="" method="post">
  						<div class="mb-3">
  							<label for="category-id" class="form-label">Id</label>
    						<input type="text" class="form-control" id="category-id" name="category_id" readonly value="<?php echo $category_id; ?>">
    						<label for="category-name" class="form-label">Title</label>
    						<input type="text" class="form-control" id="category-name" name="category_title" required value="<?php echo $category_title; ?>">
    					 </div>
    					 <input type="hidden" value="<?php echo $category_id; ?>" name="category_id">
  						<input type="submit" class="btn btn-primary" value="Update Category" name="submit">
					</form>
				</div>
			</section>
			<!--Update Form End -->

			<?php

		} 
		else
		{
			// Data is not available for this category_id 
			// Display error message and redirect to categories.php page
			$_SESSION['category_id_update'] = "<div class='error text-center'>Something went wrong with Category_id (Invaild category_id)</div>";
			//Redirect using js
			?>	

			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/categories.php';
			</script>

			<?php

		}

	}
	else
	{
		// category_id is not set
		// Error Message Display and Redirect to categories.php page
		$_SESSION['category_id_update'] = "<div class='error text-center'>Something went wrong with Category_id</div>";
		//Redirect using js
		?>

		<script type="text/javascript">
			window.location.href='<?php echo SITEURL; ?>admin/categories.php';
		</script>

		<?php
	}
	
?>

<?php 
	// check whether update button is clicked 
	if(isset($_POST['submit']))
	{
		// Get data from form
		$category_title = $_POST['category_title'];
		$category_title = mysqli_real_escape_string($conn,$category_title);
		// Update Button clicked
		// Update Query 
		$sql2 = "update tbl_categories set cat_title='$category_title' where cat_id=$category_id";	
		//Execute SQL Query
		$res2 = mysqli_query($conn,$sql2);
		//check whether Query is Successfully Executed or not
		if($res2 == TRUE)
		{
			// Success Message
			$_SESSION['category_id_update'] = "<div class='success text-center'>$category_title is Successfully Updated</div>";
			// Redirect to categories.php page
			?>

			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/categories.php';
			</script>

			<?php
		}
		else
		{
			// Error Message
			$_SESSION['category_id_update'] = "<div class='error text-center'>$category_title is not Updated</div>";
			// Redirect to categories.php page
			?>

			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/categories.php';
			</script>

			<?php
		}
	}
?>
