<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
<?php 
	// check user is logged in or not
	if(isset($_COOKIE["username"]))
	{
		// cookie remove
		setcookie("username","",time()-1);
		// Logout success message
		$_SESSION['admin-logout-status'] = "<div class='success text-center'>Succesfully Logout!</div>";
		// echo "log out ".$_SESSION['admin-logout-status'];
		if(isset($_SESSION['admin-logout-status']))
		{
			echo "logout Succesfully ";
			header("location:".SITEURL."admin-login.php");
		}
		else
		{
			echo "<div class='text-center error'>Log Out Unsuccessfull</div>";
		}
	}
	else
	{
		// user not login so redirect to admin login page
		$_SESSION['admin-logout-status'] = "<div class='error text-center'>You are already log out!</div>";
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin-login.php';
			</script>
		<?php
	}
?>