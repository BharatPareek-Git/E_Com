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
			// so need to append new product details in existing cookie or if multiple times same item is added then increase quantity by 1

			// get cookie value
			$productCookieArray = $_COOKIE['user-add-to-cart-cookie'];
			// Convert the JSON object string to a key-value pair array
			$productArray = json_decode($productCookieArray,true);

			// update cookies
			// first check product is already in cart then quantity inncrease by one
			// or new product then insert into cookie


			if(array_key_exists($_GET['pid'],$productArray))
			{
				// if key exists in the array
				// then update quantity

				// here vaildation also require 
				// when product quantity is increase then also need to check DB to cross check whether product in stock or not
				// ------------------
				$productArray[$_GET['pid']]+=1; 

				// update cookie
				// Convert the array to a JSON object string
				$jsonArray = json_encode($productArray);
				setcookie("user-add-to-cart-cookie",$jsonArray,time()+60*60*24); // vaild for one day
			}
			else
			{
				// new product 
				// direct add

				// here vaildation also require 
				// when product quantity is increase then also need to check DB to cross check whether product in stock or not
				// --------------------
				$productArray[$_GET['pid']]=1;
				// update cookie
				// Convert the array to a JSON object string
				$jsonArray = json_encode($productArray);
				setcookie("user-add-to-cart-cookie",$jsonArray,time()+60*60*24*365); // vaild for one year
			}
		}
		else
		{
			// cookie is not set 
			// so firstly set cookie

			$productArray[$_GET['pid']] = 1; // initial quantity of the product is one

			// If your array is in key-value pair, you can still use the same approach to set the array in a cookie. You just need to convert the key-value pair array to a JSON object string using the json_encode() function.

			// Convert the array to a JSON object string
			$jsonArray = json_encode($productArray);

			// set cookies
			setcookie("user-add-to-cart-cookie",$jsonArray,time()+60*60*24*365); // vaild for one year
		}

		// now check for user is authenticated or not 
		if(isset($_COOKIE['user-success-login']))
		{
			// current user is logged in
			// set cart details on Db 

			// two posible scenories 
			// 1.) user add first time product
			// 2.) more than one time user add product

			// so first check that product_id is already exist in db if yes than update by 1
			// otherwise insert product_id and initiallize by
			// data is inserted in DB using cookie
			// ----------------------------------------------------------------------------
			
			// redirect to checkout.php page 
			// cart data updation in db is  done on set-cart-data-in-db-from-cookie.php file 
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
		$_SESSION['user-add-to-cart-status'] = "<div class='error text-center'>Product not added in cart</div>";
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>';
			</script>
		<?php
	}
?>