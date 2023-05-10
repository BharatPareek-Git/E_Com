<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>	
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
		$sql_unique_username = "select * from user where username='$username'";

		// Execute SQL Query
		$res_unique_username = mysqli_query($conn,$sql_unique_username);

		// Count rows
		$count_unique_username = mysqli_num_rows($res_unique_username);
		// Check $count_unique_username is greate than zero then username is already exist
		if($count_unique_username > 0)
		{
			// Usernane is already exists
			// Error message so and redirect to same page for choose another username
			$_SESSION['user-account-creation'] = "<div class='error text-center'>Username Already Taken</div>";
			// redirect to same page
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>user-create-account.php';
				</script>
			<?php 
		}
		else
		{
			// Username is not exists so create a account
			// SO now create a account
			// SQL Query
			$sql_create_account = "insert into user (username,password) values('$username','$password')";

			// Execute Query
			$res_create_account = mysqli_query($conn,$sql_create_account);

			// Check data is inserted or not
			if($res_create_account == TRUE)
			{
				// Account is created
				// Set Cookie for login 
				// Cookie vaild for one day
				setcookie("user-success-login",$username,time()+60*60*24); 
				//  Display an Success message and redirect to same page
				$_SESSION['user-account-creation'] = "<div class='success text-center'>Welcome, $username</div>";
				// redirect to same page
				?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>index.php';
					</script>
				<?php 
			}
			else
			{
				// Account is not created
				// Display an error message and redirect to same page
				$_SESSION['user-account-creation'] = "<div class='error text-center'>Something went wrong with query</div>";
				// redirect to same page
				?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>user-create-account.php';
					</script>
				<?php 
			}
		}

	}
?>

<!-- Signup (Create Account) Form Start -->
  	<section class="vh-100">
  		<div class="container-fluid h-custom">
    		<div class="row d-flex justify-content-center align-items-center h-100">

      			<div class="col-md-9 col-lg-6 col-xl-5">
        			<img src="<?php echo SITEURL; ?>images/web-images/form-images/form-account-img.jpg"class="img-fluid" alt="Sample image">
      			</div>
      			<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
       				<form action="" method="post">
       					<div class="form-outline mb-4">
                    		<h2 class="text-center">Sign Up</h2>
          				</div>
          				<!-- Account Error and Success -->
          				<?php 
          					// account creation status
          					if(isset($_SESSION['user-account-creation']))
							{
								echo $_SESSION['user-account-creation'];
								unset($_SESSION['user-account-creation']);
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
            					<input type="submit" class="btn btn-primary btn-lg"style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit" value="Create Account">
            					<p class="small fw-bold mt-2 pt-1 mb-0">have an account? <a href="#!"class="link-success">Login</a></p>
          					</div>
          				</div>
        			</form>
    			</div>
  			</div>
  		</div>  
	</section>
  	<!-- Sign up (Craete Account) Form End -->

<!-- Include Footer Section -->
<?php 
	include_once("partials-user-front-end/user-footer.php")
?>