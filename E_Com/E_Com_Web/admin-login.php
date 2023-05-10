<!-- include constants for DB and Constants -->
<?php 
	include_once("config/constants.php");
?>
<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>
<!-- check for admin login -->	 

  	<?php 
  		// Login Error Message
  		if(isset($_SESSION['admin-login-status']))
  		{
  			// for login failed or direct use denied
  			echo $_SESSION['admin-login-status'];
  			unset($_SESSION['admin-login-status']);
  		}
  		// Logout  Message
  		if(isset($_SESSION['admin-logout-status']))
  		{
  			// for logout 
  			echo $_SESSION['admin-logout-status'];
  			unset($_SESSION['admin-logout-status']);
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
       				<form action="<?php echo SITEURL; ?>admin/login.php" method="post">
       					<div class="form-outline mb-4">
                    		<h2 class="text-center">Login</h2>
          				</div>

          				<!-- Username input -->
          				<div class="form-outline mb-4">
          					<label class="form-label" for="username-login">Username</label>
            				<input type="text" id="username-login" class="form-control form-control-lg"placeholder="Enter Username"name="admin_username" required>
          				</div>

          				<!-- Password input -->
          				<div class="form-outline mb-3">
          					<label class="form-label" for="pass-login">Password</label>
            				<input type="password" id="pass-login" class="form-control form-control-lg"placeholder="Enter password" name="admin_password" required>
          				</div>

          				<div class="d-flex justify-content-between align-items-center">
            

          					<div class="text-center text-lg-start mt-4 pt-2">
            					<input type="submit" class="btn btn-primary btn-lg"style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit" value="Login">
            					<p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"class="link-danger">Register</a></p>
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
