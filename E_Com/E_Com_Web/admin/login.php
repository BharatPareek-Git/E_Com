<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	// Check Username and password is submit or not
	if(isset($_POST['submit']))
	{
		// Submit is clicked";
		// Get Form Data
		$username = $_POST['admin_username'];
		$password = $_POST['admin_password'];

		// SQL Injection prevent
		$username = mysqli_real_escape_string($conn,$username);
		$password = mysqli_real_escape_string($conn,$password);

		// SQL Query
		$sql = "select * from admin where admin_username='$username' and admin_password='$password'";
		// Execute Query
		$res = mysqli_query($conn,$sql);
		// Count rows
		$count = mysqli_num_rows($res);
		if($count == 1)
		{
			// Data Found
			// Set cookies

			//vaild for 1 day(60*60*24)
			setcookie("username",$username,time()+60*60*24);
			
			// now redirect with success message to admin admin dashboard page
			?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin/index.php';
			</script>
			<?php
		}
		else
		{
			// Invaild Username password error display 
			$_SESSION['admin-login-status'] = "<div class='error text-center'>Invaild Username or Password</div>";
			?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin-login.php';
			</script>
			<?php
		}
	}
?>
