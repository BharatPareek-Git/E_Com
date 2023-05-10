<!-- Header file include -->
<?php 
	include_once("parital-front-end-user-dashboard/user-dashboard-header.php")
?>
<!-- Fetch data from DB and Display if available -->
<?php 
	// SQL Query
	$user_name = $_COOKIE['user-success-login'];
	$sql = "select * from user where username='$user_name'";
	// Execute SQL Query
	$res = mysqli_query($conn,$sql);
	// Count available rows
	$count = mysqli_num_rows($res);

	// Variable decalrations so all are accessable in whole page
	$password="";
	$email="";
	$first_name="";
	$last_name="";
	$address="";
	$mobile_number="";
	$profile_picture="";

	// Check data is available or not
	if($count == 1)
	{
		// Vaild user and data also found
		// GET Data 
		$row = mysqli_fetch_assoc($res);
		if($row['user_info']=='N')
		{
			$password = $row['password'];
		}
		else
		{
			$password = $row['password'];
			$email = $row['email'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$address = $row['address'];
			$mobile_number = $row['mobile_number'];
			$profile_picture = $row['profile_picture'];
		}
		
	}
	else
	{
		// Invaild user
		// Log out initiated and redirect to Home page
		$_SESSION['user-profile-update'] = "<div class='error text-center'>Something wrong went with username, you need to relogin</div>";
		// Log out initiated
		// Redirect to logout page
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>user-logout.php';
			</script>
		<?php
	}
?>
<!-- Main Content Display user data -->
<!-- Display User profile status -->
	<?php 
		if(isset($_SESSION['user-profile-update']))
		{
			echo $_SESSION['user-profile-update'];
			unset($_SESSION['user-profile-update']);
		}
	?>
<div class="user-main-container">
	<form action="" method="post" enctype="multipart/form-data">
  		<!-- User Data Display -->
  		<div class="row mb-4">
  			<div class="col">
  		    	<div class="form-outline">
  		      		<label class="form-label" for="first-name">First name</label>
  		      		<input type="text" id="first-name" class="form-control" name="first-name" required value="<?php echo $first_name; ?>" />
  		    	</div>
  		  	</div>

  		  	<div class="col">
  		   		<div class="form-outline">
  		      		<label class="form-label" for="last-name">Last name</label>
  		      		<input type="text" id="last-name" class="form-control" name="last-name" required value="<?php echo $last_name; ?>"/>
  		    	</div>
  		  	</div>
  		</div>
		
		<div class="row mb-4">
  			<div class="col">
  				<!-- User name update option is not available -->
  		    	<div class="form-outline">
  		      		<label class="form-label" for="user-name">User name</label>
  		      		<input type="text" id="user-name" class="form-control" name="user-name" required value="<?php echo$user_name; ?>" readonly />
  		    	</div>
  		  	</div>

  		  	<div class="col">
  		   		<div class="form-outline">
  		      		<label class="form-label" for="password">Password</label>
  		      		<input type="text" id="password" class="form-control" name="password" required value="<?php echo $password; ?>" />
  		    	</div>
  		  	</div>
  		</div>

  		<div class="row mb-4">
  			<div class="col">
  		    	<div class="form-outline">
  		      		<label class="form-label" for="email">Email</label>
  		      		<input type="email" id="email" class="form-control" name="email" required value="<?php echo $email; ?>" />
  		    	</div>
  		  	</div>

  		  	<div class="col">
  		   		<div class="form-outline">
  		      		<label class="form-label" for="mobile-number">Mobile</label>
  		      		<input type="number" id="mobile-number" class="form-control" min="1000000000" max="9999999999" name="mobile-number" required value="<?php echo $mobile_number; ?>" />
  		    	</div>
  		  	</div>
  		</div>

  		<div class="form-outline mb-4">
  			<label class="form-label" for="user-image">Image</label>
  		  	<input type="file" id="user-image" class="form-control" name="new-user-image" />
  		</div>

  		<div class="form-outline mb-4">
  			<label class="form-label" for="address">Address</label>
  		  	<textarea class="form-control" id="address" rows="4" name="address" required><?php echo $address; ?></textarea>
  		</div>

 		<!-- Submit button -->
 		<input type="hidden" name="old-img" value="<?php echo $profile_picture; ?>">
  		<input type="submit" class="btn btn-primary btn-block mb-4 t" value="Update"  name="submit" />
	</form>
	
	<!-- Data Update -->
	<?php 
		// Check submit button is clicked or not
		if(isset($_POST['submit']))
		{
			// Button is cliked
			// GET Data from form
			$firstname = $_POST['first-name'];
			$lastname = $_POST['last-name'];
			$username = $_POST['user-name'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$mobilenumber = $_POST['mobile-number'];
			$address = $_POST['address'];
			$newimage = "";
			$oldimg = "";
 			$newimage = $_FILES['new-user-image']['name'];
			$oldimg = $_POST['old-img'];
			// echo "new : ".$newimage;
			
			// Check image is selected or not
			// if new image is empty then no need to delete old image
			if($newimage!="")
			{
				// New image is selected

				// if we have old image in DB then need to delete that image
				if($oldimg != "")
				{
					// Now Delete image
					$imgpath = "images/web-images/user-default/".$oldimg;
					$img_remove = unlink($imgpath);

					// Check image is removed or not
					if($img_remove == false)
					{
						$_SESSION['user-profile-update'] = "<div class='error text-center'>Something went wrong with user image (Old image deletion at local storage)</div>";
						// Redirect to same page
						?>
							<script type="text/javascript">
								window.location.href='<?php echo SITEURL; ?>user-profile.php';
							</script>
						<?php
						// die code using die() method
						die();
					}
				}

				// store this image in local storage

				// now upload image
				$source_path = $_FILES['new-user-image']['tmp_name'];
				$destination_path = "images/web-images/user-default/".$newimage;

				// Upload image 
				$upload = move_uploaded_file($source_path,$destination_path);// returns 1 if image or file is successfully uploaded

				// Check image is successfully uploaded or not
				if($upload == false)
				{
					// image is not uploaded 
					// display an error message
					$_SESSION['user-profile-update'] = "<div class='error text-center'>Something went wrong with user image</div>";
					// Redirect to same page
					?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>user-profile.php';
					</script>
					<?php
					// die code using die() method
					die();
				}
			}

			// if control came here means image is successfully uploaded.
			// or may be new image is not selected 

			// Upload SQL Query
			// Query as per image is uploaded or not
			$sql_user_upload = "";
			if($newimage!="")
			{
				// Image is not upload
				$sql_user_upload = "update user set password=$password,email='$email',first_name='$firstname',last_name='$lastname',address='$address',mobile_number='$mobilenumber',profile_picture='$newimage',user_info='Y'";
				echo $sql_user_upload;
			}
			else
			{
				// image is upload
				$sql_user_upload = "update user set password=$password,email='$email',first_name='$firstname',last_name='$lastname',address='$address',mobile_number='$mobilenumber',user_info='Y'";
				echo $sql_user_upload;
			}

			// Execute SQL Query
			$res_user_upload = mysqli_query($conn,$sql_user_upload);
			// Check Query is executed successfully or not
			if($res_user_upload == TRUE)
			{
				// Query is Executed
				// Now Check number of affected rows 
				// if rows == 1 then data is also updated
				if(mysqli_affected_rows($conn))
				{
					// Data is successfully updated
					$_SESSION['user-profile-update'] = "<div class='success text-center'>User Data updated Successfully!</div>";
					// Redirect to same page
					?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>user-profile.php';
					</script>
					<?php
				}
				else
				{
					// One Bug found if we directly clicked on update button without changing data then affected rows are zero and this else block is executed

					// Data is not updated (user name not found in DB)
					$_SESSION['user-profile-update'] = "<div class='error text-center'>Something wrong went with username, you need to relogin</div>";
					// Log out initiated
					// Redirect to logout page
					?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>user-logout.php';
					</script>
					<?php	
				}
			}
			else
			{
				// Error message display
				$_SESSION['user-profile-update'] = "<div class='error text-center'>Something went wrong with Query</div>";
					// Redirect to same page
					?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>user-profile.php';
					</script>
					<?php
					// die code using die() method
					die();
			}
		}
	?>
</div>
<!-- Footer file include -->
<?php 
	include_once("parital-front-end-user-dashboard/user-dashboard-footer.php")
?>

<!-- Check 224-->