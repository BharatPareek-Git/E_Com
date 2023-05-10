<!-- include constants for DB and Constants -->
<?php 
	include_once("config/constants.php");
?>
<!-- Logout -->
<?php 
	// check user is logged in or not
	if(isset($_COOKIE["user-success-login"]))
	{
		// cookie remove
		setcookie("user-success-login","",time()-1);
		// Logout success message
		$_SESSION['user-logout-status'] = "<div class='success text-center'>Succesfully Logout!</div>";
		// echo "log out ".$_SESSION['admin-logout-status'];
		if(isset($_SESSION['user-logout-status']))
		{
			echo "logout Succesfully ";
			// Redirect so success message will display
			header("location:".SITEURL);
		}
		else
		{
			echo "<div class='text-center error'>Log Out Unsuccessfull</div>";
			// Redirect so success message will display
			// header("location:".SITEURL);
		}
	}
	else
	{
		// user not login so redirect to admin login page
		$_SESSION['user-logout-status'] = "<div class='error text-center'>You are already log out!</div>";
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>';
			</script>
		<?php
	}
?>