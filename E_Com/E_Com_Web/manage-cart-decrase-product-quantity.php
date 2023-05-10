<!-- include constants for DB and Constants -->
<?php 
	include_once("config/constants.php");
?>
<!-- Now check product id is set or not -->
<?php 
	if(isset($_GET['pid']))
	{
		$productArray = array();
		// product id is set

		// set cookies for product
		// first check cookie is already set or not
		if(isset($_COOKIE['user-add-to-cart-cookie']))
		{
			// cookie is already set 
			// so need to decrease product quantity by 1 in existing cookie 

			// get cookie value
			$productCookieArray = $_COOKIE['user-add-to-cart-cookie'];
			// Convert the JSON object string to a key-value pair array
			$productArray = json_decode($productCookieArray,true);

			// update cookies
			// first check product is already in cart then quantity decrease by one(must condition)
			// or if product not available then error message display


			if(array_key_exists($_GET['pid'],$productArray))
			{
				// if key exists in the array
				// then update quantity
				if($productArray[$_GET['pid']] >= 1)
				{
					// mean we can decrease product by 1
					// this vaildation helps in to prevent neagative quamtity
					$productArray[$_GET['pid']]-=1; 

					// update cookie
					// Convert the array to a JSON object string
					$jsonArray = json_encode($productArray);
					setcookie("user-add-to-cart-cookie",$jsonArray,time()+60*60*24); // vaild for one day
				}
				else
				{
					// remove product from cart
					// beacuse quantity of product is now 0
  					// to remove key value from an array in php we use unset methode
  					unset($productArray[$_GET['pid']]);
  					// update cookies
  					// create json object
  					$jsonArray_productArray = json_encode($productArray);
  					setcookie("user-add-to-cart-cookie",$jsonArray_productArray,time()+60*60*24*365);
				}
				
			}
			else
			{
				// error message please add this product first
				// Redirect to home page with an error message
				$_SESSION['user-add-to-cart-status'] = "<div class='error text-center'>Please add this product in cart first</div>";
				?>
					<script type="text/javascript">
						window.location.href='<?php echo SITEURL; ?>checkout.php';
					</script>
				<?php
			}
		}
		else
		{
			// cookie is not set 
			// so display an error message invaild product

			
		}

		// Know check for user is authenticated or not 
		if(isset($_COOKIE['user-success-login']))
		{
			// current user is logged in
			// set cart details on Db 
			// -----------------------------------
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>checkout.php';
				</script>
			<?php
		}
		else
		{
			// current user is not logged in
			// so product details are stored in cookies using an array (key value pair manner) key is product id and value is quantity of that product

			// Redirect to checkout page and update cart 
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>checkout.php';
				</script>
			<?php
		}
	}
	else
	{
		// product id is not set
		// Redirect to home page with an error message
		$_SESSION['user-add-to-cart-status'] = "<div class='error text-center'>Something went wrong with product_id</div>";
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>';
			</script>
		<?php
	}
?>