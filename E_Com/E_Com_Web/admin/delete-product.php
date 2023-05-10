<!-- include constants so DB and constant are used -->
<?php 
	include_once("../config/constants.php");
?> 

<?php 
	// Check id is set or not
	if(isset($_GET['id']))
	{
		// id is set
		$id = $_GET['id'];

		// Image name fetch from DB
		$sql_img = "select * from tbl_products where product_id=$id";
		// Execute Query
		$res_img = mysqli_query($conn,$sql_img);
		// fecth data 
		$row_img = mysqli_fetch_assoc($res_img);

		// SQL Query for delete
		$sql = "delete from tbl_products where product_id=$id";
		// execute query

		$res = mysqli_query($conn,$sql);

		// count affected rows
		// $count = mysqli_affected_rows($conn);
		// check whether query is executed or not
		
		if($res == TRUE)
		{
			if(mysqli_affected_rows($conn))
			{
				// Product successfully deleted from DB
				// But now we need to delete product image from local storage
				// if control came here means passed category is vaild so here we get image_name
				$img_name = $row_img['product_image'];
				// Delete image first
				$img_path = "../images/product_images/".$img_name;

				// To delete image or file we use unlink method which take path_of_img as a parameter
				$img_remove = unlink($img_path);

				// Check image deleted or not
				if($img_remove == false)
				{
					// image not deleted
					// display an error message and redirect
					$_SESSION['delete-product-img-status'] = "<div class='error text-center'>Product Image Not Deleted</div>";
					
					// Success message and redirect
					$_SESSION['delete-product-status'] = "<div class='success text-center'>Product deleted Successfully</div>";
			 		// Redirect to view-products.php using js
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
						</script>
					<?php 
				}
				else
				{
					// image successfully deleted
					// Prodct also Successfully deleted

					// Success message and redirect
					$_SESSION['delete-product-status'] = "<div class='success text-center'>Product deleted Successfully</div>";
			 		// Redirect to view-products.php using js
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
						</script>
					<?php 
				}
				
			}
			else
			{
				// id is invaild so deletion not performe 
				$_SESSION['delete-product-status'] = "<div class='error text-center'>Something went wrong Product_id</div>";
				// Redirect to view-products.php using js
				?>

				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
				</script>

				<?php 
			}
			
		}
		else
		{
			// Product not deletd and show an error message
			$_SESSION['delete-product-status'] = "<div class='error text-center'>Something went wrong with Query</div>";
			// Redirect to view-products.php using js
			?>

			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
			</script>

			<?php 
		}
	}
	else
	{
		// id is not set and show an error message and redirect 
		$_SESSION['delete-product-status'] = "<div class='error text-center'>Products Id is not set</div>";
		// Redirect to view-products.php using js
		?>

		<script type="text/javascript">
			window.location.href='<?php echo SITEURL; ?>admin/view-products.php';
		</script>

		<?php 
	}
?>