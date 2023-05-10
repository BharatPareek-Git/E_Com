<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
<!-- include header part -->
<?php 
	include_once("../partials-front-end/header-menu.php");
?>
<div class="user-main-container" style="width:90%; margin-left: 3%;">
	<?php 
		// display status
		if(isset($_SESSION['delivery-update']))
		{
			echo $_SESSION['delivery-update'];
			unset($_SESSION['delivery-update']);
		}
	?>
	<!-- display all orders till date -->
	<h4 class="text-center">All Orders</h4>
	<table class="table table-bordered" style="margin: 2%;">
  		<thead>
    		<tr>
      			<th scope="col">S.N</th>
      			<th scope="col" colspan="2">Product</th>
      			<th scope="col">Payment</th>
      			<th scope="col">Delivery</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php 
  				// fetch all orders
  				$sql_orders = "select * from tbl_orders";
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
  										
  									}
      							?>
      							<td>
      								<!-- product details -->
      								<?php echo $product_title; ?>
      							</td>
      							<td>
      								<?php 
      									if($product_img!="")
  											{
  												?>
  													<img src="<?php echo SITEURL; ?>images/product_images/<?php echo $product_img; ?>" style="width: 10%;">
  												<?php
  											}
      								?>	
      							</td>
      							<td>
      								<?php 
      									if($payment_status=='Y')
      									{
      										echo "<small>Done</small>";
      									}
      									else
      									{
      										echo "<small>Not yet</small>";
      									}
      									?>
       							</td>
      							<td>
      								<?php 
      									if($delivery_status=='Y')
      									{
      										echo "<small>Y</small>";
      									}
      									else
      									{
      										echo "<small>N</small>";
      									}
      									?>
      									<a href="<?php echo SITEURL; ?>admin/delivery-update.php?oid=<?php echo $order_id; ?>">
      										<i class="fa-solid fa-rotate" style="color: #1660df;"></i>
      									</a>
      							</td>

    						</tr>
    					<?php
  					}
  				}

  			?>
  		</tbody>
	</table>
</div>
<!-- Footer part include -->
<?php 
	include_once("../partials-front-end/footer.php");
?>