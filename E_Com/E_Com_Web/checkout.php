<!-- Header file include -->
<?php 
	include_once("partials-user-front-end/user-header.php");
?>

<?php 
	$item_qunatity = 0;
	$item_total_amount = 0;
?>
<!-- Check Out Table Start -->
	<?php 
		// db cart status
	if(isset($_SESSION['user-add-to-cart-status-db']))
	{
		echo $_SESSION['user-add-to-cart-status-db'];
		unset($_SESSION['user-add-to-cart-status-db']);

	}
	?>
  	<section class="session-checkout p-4">
  		<h2>Checkout</h2>
  		<form>
  			<table class="table table-responsive">
  				<thead>
    				<tr>
      					<th><small>Product</small></th>
      					<th><small>Price</small></th>
      					<th><small>Quantity</small></th>
      					<th colspan="2"><small>Subtotal</small></th>	
    				</tr>
  				</thead>
 				<tbody>
 					<?php 
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
  										$cart_product_title = $row_cart_product['product_title'];
  										$cart_product_image = $row_cart_product['product_image'];
  										$cart_product_price = $row_cart_product['product_price'];
  										$cart_product_quantity = $value;
  										$cart_product_sub_total = $cart_product_price * $cart_product_quantity;


  										// data order page like number or products added in cart and price
  										$item_qunatity+=1; 
										$item_total_amount += $cart_product_sub_total;
  									}
  									?>
  										<?php 
  											// vaildation
  											// if product quantity is greater than or eqaul 1 then only display product in cart
  											// otherwise remove product from cart
  											if($cart_product_quantity >= 1)
  											{
  												?>
  												 	<tr>
  														<td>
  												<?php
  															// display cart data
  															echo "<small>$cart_product_title</small><br>";
   		  
	  														// Display image if avilable
  															if($cart_product_image!="")
  															{
  																// display image
  																?>
  																	<img src="<?php echo SITEURL ?>images/product_images/<?php echo $cart_product_image; ?>" style="width:100px">
  																<?php 
  															}
  															else
  															{
  																echo "<small class='error'>image not fount</small>";
  															}
  																?>
  														</td>
  																
  														<td>
  															<?php echo $cart_product_price; ?>
  														</td>
  														<td>
  															<?php echo $cart_product_quantity; ?>
  														</td>
  														<td>
  															<?php echo $cart_product_sub_total; ?>
  														</td>
  														<td>
  															<a class="btn btn-warning" href="<?php echo SITEURL; ?>manage-cart-decrase-product-quantity.php?pid=<?php echo $key; ?>">-</a>
  															<a class="btn btn-success" href="<?php echo SITEURL; ?>manage-cart.php?pid=<?php echo $key; ?>">+</a>
  															<a class="btn btn-danger" href="<?php echo SITEURL; ?>manage-cart-remove-product-quantity.php?pid=<?php echo $key; ?>">x</a>
  														</td>
  													</tr>
  										<?php	
  											} 
  											else
  											{
  												// remove product from cart
												// beacuse quantity of product is now 0
  												// to remove key value from an array in php we use unset methode

  												unset($productCartArrayCookie[$key]);
  												// update cookies
  												// create json object
  												$jsonArray_productArray = json_encode($productCartArrayCookie);
  												setcookie("user-add-to-cart-cookie",$jsonArray_productArray,time()+60*60*24*365);
  											}
  								}
  								else
  								{
  									// display error message please add product first
  								}
  							}
  				
  						}
  				 
  					?>
  				</tbody>
			</table>
			<?php 
				if($item_qunatity > 0)
				{
					?>
						<form method="get" action="">
							<input type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="buy-now" value="Buy now">
						</form>
					<?php
				}
			?>
			
			<!-- Cart Total Start-->
			<div class="cart-total">
				<h3>Cart Total</h3>
				<table class="table table-bordered table-responsive" cellspacing="0">
  					<thead>
    					<tr>
      						<th>Items</th>
      						<td>
      							<?php echo $item_qunatity; ?>
      						</td>
    					</tr>
  					</thead>
 					<tbody>
    					<tr>
      						<th>Shipping and Handling</th>
      						<td>
      							<?php 
      								// if order ammount is greate or equal 500 then free shipping other wise 99 rupees extra charge apply
      								if($item_total_amount >= 500 and $item_qunatity >= 1)
      								{
      									echo "Free Shipping";
      								}
      								else if($item_qunatity == 0)
      								{
      									echo "0";
      								}
      								else 
      								{
      									// extra 99 rupees charged 
      									$item_total_amount += 99; 
      									echo "99";
      								}
      							?>
      							
      						</td>
    					</tr>
    					<tr>
      						<th>Order Total</th>
      						<td>
      							<?php echo $item_total_amount; ?>
      						</td>
    					</tr>
  					</tbody>
				</table>
			</div>
			<!-- Cart Total End -->
		</form>
  	</section>
    <!-- Check Out Table End -->
<!-- Include Footer Section -->
<?php 
	include_once("partials-user-front-end/user-footer.php");
?>

<?php 
	if(isset($_GET['buy-now']))
	{
		// Rediect to buy now page
		?>
			<script type="text/javascript">
				window.location.href='<?php echo SITEURL; ?>buy-now.php';
			</script>
		<?php 
	}
?>