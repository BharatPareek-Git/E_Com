
<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>
<!-- Login Success or not -->
<?php 
	// check submit button is clicked or not
	if(isset($_POST['submit']))
	{
		// Submit button is clicked
		// GET Data from form
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Prevent SQL Injection
		$username = mysqli_real_escape_string($conn,$username);
		$password = mysqli_real_escape_string($conn,$password);

		// Check user name is already exist or not
		// SQL Query 
		$sql_unique_username = "select * from user where username='$username' and password='$password'";

		// Execute SQL Query
		$res_unique_username = mysqli_query($conn,$sql_unique_username);

		// Count rows
		$count_unique_username = mysqli_num_rows($res_unique_username);
		// Check $count_unique_username is greate than zero then username is already exist
		if($count_unique_username > 0)
		{
			// Username and password is correct and login success
			// Set cookie which vaild for one day
			setcookie("user-success-login",$username,time()+60*60*24);
			// Rediect to home page
			//  Display an Success message and redirect to same page
			$_SESSION['user-account-login'] = "<div class='success text-center'>Welcome, $username</div>";
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>index.php';
				</script>
			<?php 
		}
		else
		{
			// Username or password is wrong so failed in login 
			// Display error message and redirect to user-login.php
			echo "Invaild";
			$_SESSION['user-account-login'] = "<div class='error text-center'>Invaild Username or Password</div>";
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>user-login.php';
				</script>
			<?php 
		}

	}
?>
<!-- Login Form Start -->
  	<section class="vh-100">
  		<div class="container-fluid h-custom">
    		<div class="row d-flex justify-content-center align-items-center h-100">

      			<div class="col-md-9 col-lg-6 col-xl-5">
        			<img src="<?php echo SITEURL; ?>images/web-images/form-images/form-account-img.jpg"class="img-fluid" alt="Sample image">
      			</div>
      			<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
       				<form action="" method="post">
       					<div class="form-outline mb-4">
                    		<h2 class="text-center">Log in</h2>
          				</div>
          				<!-- Account Error and Success -->
          				<?php 
          					// account creation status
          					if(isset($_SESSION['user-account-creation']))
							{
								echo $_SESSION['user-account-creation'];
								unset($_SESSION['user-account-creation']);
							}
							// account login status
          					if(isset($_SESSION['user-account-login']))
							{
								echo $_SESSION['user-account-login'];
								//unset($_SESSION['user-account-login']);
							}
          				?>
          				<!-- User Name input -->
          				<div class="form-outline mb-4">
          					<label class="form-label" for="username-login">Username</label>
            				<input type="text" id="username-login" class="form-control form-control-lg"placeholder="Enter Username"name="username"/>
          				</div>

          				<!-- Password input -->
          				<div class="form-outline mb-3">
          					<label class="form-label" for="pass-login">Password</label>
            				<input type="password" id="pass-login" class="form-control form-control-lg"placeholder="Enter password" name="password" />
          				</div>

          				<div class="d-flex justify-content-between align-items-center">

          					<div class="text-center text-lg-start mt-4 pt-2">
            					<input type="submit" class="btn btn-primary btn-lg"style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit" value="Login">
            					<p class="small fw-bold mt-2 pt-1 mb-0">haven't account? <a href="#!"class="link-success">Register</a></p>
          					</div>
          				</div>
        			</form>
    			</div>
  			</div>
  		</div>  
	</section>
  	<!-- Login Form End -->
<!-- Include Footer Section -->
<?php 
	include_once("partials-user-front-end/user-footer.php")
?>
