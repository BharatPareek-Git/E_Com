<?php 
	// check user is logged in or not
	if(isset($_COOKIE["user-success-login"]))
	{
		// Login success
	}
	else
	{
		// user not authenticate so redirect to admin login page
		$_SESSION['user-profile-check-authentication'] = "<div class='error text-center'>Please login to Access This Page</div>";
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>';
			</script>
		<?php
	}
?>