<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	include_once("../partials-front-end/header-menu.php");
	// Create form to add category 
?>
	<?php 
		//Category add status
		if(isset($_SESSION['cat_add_status']))
		{
			echo $_SESSION['cat_add_status'];
			unset($_SESSION['cat_add_status']);
		}

		//Category delete status
		if(isset($_SESSION['category_id_delete']))
		{
			echo $_SESSION['category_id_delete'];
			unset($_SESSION['category_id_delete']);
		}

		//Category update status
		if(isset($_SESSION['category_id_update']))
		{
			echo $_SESSION['category_id_update'];
			unset($_SESSION['category_id_update']);
		}
	?>

	<!-- Form Start -->
	<section class="category-div">
		<div class="category-div-form">
			<h2>Product Categories</h2>
			<form action="" method="post">
  				<div class="mb-3">
    				<label for="category-name" class="form-label">Title</label>
    				<input type="text" class="form-control" id="category-name" name="category" required>
    			 </div>
  				<input type="submit" class="btn btn-primary" value="Add Category" name="submit">
			</form>
		</div>
	</section>
	<!-- Form End -->
	<?php

	// Check Whether Category add button is clicked or not 
	// if clicked then data is insert into DB

	if(isset($_POST['submit']))
	{
		// get the data from category form
		$category_title = $_POST['category'];
		// prevent SQL Injection
		$category_title = mysqli_real_escape_string($conn,$category_title);
		//SQL Query for adding data into Category Table
		$sql = "insert into tbl_categories (cat_title) values('$category_title')";
		
		// DB connected
		// inset Data

		//Execute the SQL Query
		$res = mysqli_query($conn,$sql);

		//check query is executed or not
		if($res==true)
		{
			// Data is Added 
			$_SESSION['cat_add_status'] = "<div class='success text-center'>Category Added Successfully</div>";
			// Rediect to this page so message will display
			// header("location:".SITEURL."admin/categories.php");//warnning so now we redirect using js
			?>

			<script type="text/javascript">
				window.location.href='<?php echo SITEURL;?>admin/categories.php';
			</script>

			<?php
		}
		else
		{
			// Data is Not Added
			$_SESSION['cat_add_status'] = "<div class='error text-center'>Category Added Successfully</div>";
			// Rediect to this page so message will display
			// header("location:".SITEURL."admin/categories.php");//warnning so now we redirect using js
			?>

			<script type="text/javascript">
				window.location.href='<?php echo SITEURL;?>admin/categories.php';
			</script>

			<?php
		}

	}

	// Display All Added Categories and provide option for update and delete
	// SQL Query to Fetch Data From  DB
	$sql2 = "select * from tbl_categories";

	//Execute the Query
	$res2 = mysqli_query($conn,$sql2);

	//Count Rows to check Whether we have Data in DB or not
	$count2 = mysqli_num_rows($res2);

	//Check Rows are available or not
	if($count2 > 0)
	{
		//We have Data so Display
		?>

		<div class="category-div-Display">
			<div class="category-div-Display-main">
				<!-- <h3>Categories</h3> -->

					<table class="table table-bordered">
  							<thead>
  							 	<tr>
  							    	<th>Id</th>
  							    	<th>Title</th>
  							    	<th colspan="2">Action</th>
  							  	</tr>
  							</thead>
  							<tbody>
							<!-- Fetch Data -->
							<?php 

							while($row2=mysqli_fetch_assoc($res2))
							{
								$category_id = $row2['cat_id'];
								$category_title = $row2['cat_title'];

								// Display

							?>

						
  							<tr>
  							  	<th><?php echo $category_id; ?></th>
  							    <td><?php echo $category_title; ?></td>
  							    <td>
  							    	<a href="<?php echo SITEURL; ?>admin/update-category.php?category_id=<?php echo $category_id; ?>">
  							    		<i class="fa-solid fa-square-pen fa-2xl" style="color: #3170dd;"></i>
  							    	</a>
  							    </td>
  							    <td>
  							    	<a href="<?php echo SITEURL; ?>admin/delete-category.php?category_id=<?php echo $category_id; ?>">
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
	}
	else
	{
		echo "<div class='error text-center'>Category Not Found</div>";
	}
			?>

			</div>
		</div>

<!-- Footer part include -->
<?php 
	include_once("../partials-front-end/footer.php");
?>