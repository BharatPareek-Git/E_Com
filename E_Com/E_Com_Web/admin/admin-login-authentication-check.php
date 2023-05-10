<?php 
	// check user is logged in or not
	if(isset($_COOKIE["username"]))
	{
		// Login success
		$greeting = "<div class='text-center success'>Welcome ".$_COOKIE["username"]."!</div>";
		// echo $greeting;
	}
	else
	{
		// user not login so redirect to admin login page
		$_SESSION['admin-login-status'] = "<div class='error text-center'>Please login to Access Admin Page</div>";
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>admin-login.php';
			</script>
		<?php
	}
?>