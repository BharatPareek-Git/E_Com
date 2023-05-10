<!-- Header file include -->
<?php 
	include_once("parital-front-end-user-dashboard/user-dashboard-header.php")
?>
<div class="user-main-container">
	<?php 
		if(isset($_SESSION['payment-msg']))
		{
			echo $_SESSION['payment-msg'];
			unset($_SESSION['payment-msg']);
		}
	?>
	<!-- display all orders till date -->
	<h4 class="text-center text-muted">Your Orders</h4>
	<hr>
	<table class="table">
  		<thead>
    		<tr>
      			<th scope="col">S.N</th>
      			<th scope="col">Product</th>
      			<th scope="col">Quantity</th>
      			<th scope="col">Amount</th>
      			<th scope="col">Delivery status</th>
      			<th scope="col">Action</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php 
  				// find user id from db
  				$username = $_COOKIE['user-success-login'];
  				// SQL Query
  				$sql_userdata = "select * from user where username='$username'";
  				// Execute SQL Query
  				$res_userdata = mysqli_query($conn,$sql_userdata);
  				// count availble rows
  				$count_userdata = mysqli_num_rows($res_userdata);

  				// fetch userid
  				$row_userdata = mysqli_fetch_assoc($res_userdata);
  				$user_id = $row_userdata['user_id'];

  				// fetch all orders
  				$sql_orders = "select * from tbl_orders where user_id='$user_id' order by $user_id desc";
  				// Execute SQL Query
  				$res_orders = mysqli_query($conn,$sql_orders);
  				// count availble rows
  				$count_orders = mysqli_num_rows($res_orders);

  				if($count_orders >= 1)
  				{
  					// Display data
  					$sn=1;
  					while($row_orders = mysqli_fetch_assoc($res_orders))
  					{
  						// data
  						$order_id = $row_orders['order_id'];
  						$product_id = $row_orders['product_id'];
  						$order_amount = $row_orders['order_amount'];
  						$product_quantity = $row_orders['product_quantity'];
  						$payment_status = $row_orders['payment_status'];
  						$delivery_status = $row_orders['delivery_status'];
  						?>
  							<tr>
      							<td><?php echo $sn++; ?></td>
      							<td>
      								<!-- product details -->
      								<?php 
      								// SQL Query
      								$sql_product_data = "select * from tbl_products where product_id=$product_id";
  									// Execute SQL Query
  									$res_product_data = mysqli_query($conn,$sql_product_data);
  									// count availble rows
  									$count_product_data = mysqli_num_rows($res_product_data);

  									if($count_product_data >= 1)
  									{
  										$row_product_data = mysqli_fetch_assoc($res_product_data);
  										$product_title = $row_product_data['product_title'];
  										$product_img = $row_product_data['product_image'];

  										// display
  										// echo "$product_title";
  											if($product_img!="")
  											{
  												?>
  													<img src="<?php echo SITEURL; ?>images/product_images/<?php echo $product_img; ?>" style="width: 10%;">
  												<?php
  											}
  									}


      								?>
      							</td>
      							<td>
      								<?php echo $product_quantity; ?>	
      							</td>
      							<td>
      								<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> <?php echo $order_amount; ?>
      							</td>
      							<td class="text-danger">
      								<?php 
      									if($delivery_status=='Y')
      									{
      										echo "Delivered";
      									}
      									else
      									{
      										echo "On the way";
      									}
      								?>
      							</td>
      							<td>
      								<?php 
      									if($delivery_status=='N')
      									{
      										if($payment_status!='Y')
      										{
      											// pay now option
      											?>
      											<a href="<?php echo SITEURL; ?>order-pay-now.php?oid=<?php echo $order_id; ?>">
      												<button type="button" class="btn btn-success">Pay Now</button>
      											</a>
      											<?php
      										}
      							
      									}
      									else
      									{
      										// Review option
      										?>
      										<a href="<?php echo SITEURL; ?>product-review.php?oid=<?php echo $order_id; ?>">
      											<button type="button" class="btn btn-primary">Write Review</button>
      										</a>
      										<?php
      									}
      									
      								?>
      							</td>
    						</tr>
    					<?php
  					}
  				}

  			?>
  		</tbody>
	</table>
</div>
<!-- Footer include -->
<?php 
	include_once("parital-front-end-user-dashboard/user-dashboard-footer.php")
?>
