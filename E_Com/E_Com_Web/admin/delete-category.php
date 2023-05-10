<!-- include constants so DB and constant are used -->
<?php 
	include_once("../config/constants.php");
?>
<?php 
	// First check whether category_id is set or not 
	// When category_id is set by URL so method is used to check is GET
	if(isset($_GET['category_id']))
	{
		// category_id is set
		// now category is delete
		// SQL Query
		$category_id = $_GET['category_id'];
		$sql = "select * from tbl_categories where cat_id=$category_id";

		//Execute the query
		$res = mysqli_query($conn,$sql);

		//count available rows for Query
		$count = mysqli_num_rows($res);

		// check row is found or not 
		// as we know category_id is unique and so here we get only one unique row for every category_id
		if($count == 1)
		{
			// Row is found
			// SQL Query for Delete
			$sql2 = "delete from tbl_categories where cat_id=$category_id";

			// Execute Query
			$res2 = mysqli_query($conn,$sql2);

			// Check Whether Query is Executed or not
			if($res2 == TRUE)
			{
				// SQL Query is Execueted and Deletion is complete
				$_SESSION['category_id_delete'] = "<div class='success text-center'>Category Successfully Deleted</div>";
				// Redirect to categories.php so error message will display
				?>

				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>admin/categories.php';
				</script>

				<?php
			}
			else
			{
				// SQL Query is not Execueted
				$_SESSION['category_id_delete'] = "<div class='error text-center'>Something went wrong !</div>";
				// Redirect to categories.php so error message will display
				?>

				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>admin/categories.php';
				</script>

				<?php
			}


		}
		else
		{	
			// Requried category not exists in DB so deletion is  not performed and also display an error
			$_SESSION['category_id_delete'] = "<div class='error text-center'>Category Not Found (Invaild Category)</div>";
			//Redirect to categories.php so error message will display
			?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/categories.php';
			</script>	
			<?php

		}
	} 
	else
	{
		// echo "error";	 
		// category_id is set
		// display error message (category_id is not set)
		$_SESSION['category_id_delete'] = "<div class='error text-center'>Something went wrong (category_id is not set)</div>";
		// Now Redirect to categories.php page so error mesage will display and redirect using js 
		echo "error";
		?>

		<script type="text/javascript">
			window.location.href='<?php echo SITEURL; ?>admin/categories.php';
		</script>

		<?php
	}
?>