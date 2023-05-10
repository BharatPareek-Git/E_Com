<?php 
	// header
	include_once("partials-user-front-end/user-header.php");
	// first check user looged in or not
	include_once("user-authenication-check.php");

	// buy now logic
	if(isset($_COOKIE['user-add-to-cart-cookie']))
  	{
  		$productCartArrayCookie = $_COOKIE['user-add-to-cart-cookie'];
  		// decode from json string object
  		$productCartArrayCookie = json_decode($productCartArrayCookie,true);
  		
  		// need to get all product is so iterate array using foreach
  		foreach ($productCartArrayCookie as $key => $value)
  		{
  			// SQL Query
  			$sql_cart_product = "select * from tbl_products where product_id=$key";
  			// Execute SQL Query
  			$res_cart_product = mysqli_query($conn,$sql_cart_product);
  			// count availble rows
  			$count_cart_product = mysqli_num_rows($res_cart_product);

  			// check data is available for display or not
  			if($count_cart_product == 1)
  			{
  				// Display data
  				while($row_cart_product = mysqli_fetch_assoc($res_cart_product))
  				{
  					$available_quantity = $row_cart_product['product_quantity'];
  					$cart_product_title = $row_cart_product['product_title'];
  					$cart_product_image = $row_cart_product['product_image'];
  					$cart_product_price = $row_cart_product['product_price'];
  					$cart_product_id = $row_cart_product['product_id'];
  					// check demand can fulfil or not and take action according to stock
  					if(($available_quantity >= $value) and ($value > 0 and $available_quantity > 0) )
  					{
  						// find user id from db
  						$username = $_COOKIE['user-success-login'];
  						$sql_userdata = "select * from user where username='$username'";
  						// Execute SQL Query
  						$res_userdata = mysqli_query($conn,$sql_userdata);
  						// count availble rows
  						$count_userdata = mysqli_num_rows($res_userdata);

  						// fetch userid
  						$row_userdata = mysqli_fetch_assoc($res_userdata);
  						$user_id = $row_userdata['user_id'];

  						// first update order database
  						// SQL Query
  						$order_amount = $cart_product_price * $value; // here $value is quantity
  						$sql_order = "insert into tbl_orders (user_id,order_amount,product_id,product_quantity) values($user_id,$order_amount,$cart_product_id,$value)";
  						// Execute SQL Query
  						$res_order = mysqli_query($conn,$sql_order);
  						// check query is executed or not
  						if(mysqli_affected_rows($conn) > 0) 
  						{
 					 		// data successfully inserted 
 					 		// so now need to update product table 
 					 		// update product quantity

  							// SQL Query 
  							$new_product_quantity = $available_quantity - $value;
  							$sql_product_update = "update tbl_products set product_quantity=$new_product_quantity where product_id=$cart_product_id";
  							// Execute SQL Query
  							$res_product_update = mysqli_query($conn,$sql_product_update);
  							// check data is successfully updated or not
  							if (mysqli_affected_rows($conn) > 0)
  							{
  								// successfully updated
  							}
  							else
  							{
  								// now quantity is not updated
  								echo "<div class='error text-center'>now quantity is not updated in tbl_products</div>";
  								die();
  							}

						}
						else 
						{
							// execute when data not inserted on DB
  							echo "<div class='text-center error'>Order can't place</div>";
  							// die rest of code
  							die();
						}

  					}
  					else
  					{
  						// order not completed message 
  						echo "<div class='text-center error'>Your order for $cart_product_title is not completed, due to insufficient stock (<span class='success'>available stock is $available_quantity</span>)*</div>";
  						die();

  					}
  				}

  			}
  		}
  		// order successfully place now need to display success message
  		echo "<div class='success text-center'>Congratulations! Your order is place</div>";
  		// remove cart data
  		setcookie('user-add-to-cart-cookie','',time() - 1);

  	}
  	else
  	{
  		echo "<div class='error text-center'>Something went wrong</div>";
  	}
?>

<?php 
	// footer
	include_once("partials-user-front-end/user-footer.php");
?>