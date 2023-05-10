<!-- include constants for DB and Constants -->
<?php 
	include_once("../config/constants.php");
?>
 <!-- Check user is logged in or not -->
<?php 
	include_once("admin-login-authentication-check.php");
?>
<?php 
	// check order id is set or not
	if(isset($_GET['oid']))
	{
		$order_id = $_GET['oid'];
		// first check current status of delivery
		$sql_orders = "select * from tbl_orders where order_id=$order_id";
  		// Execute SQL Query
  		$res_orders = mysqli_query($conn,$sql_orders);
  		// count availble rows
  		$count_orders = mysqli_num_rows($res_orders);

  		if($count_orders == 1)
  		{
  			$row_orders = mysqli_fetch_assoc($res_orders);
  			$current_status = $row_orders['delivery_status'];

  			if($current_status == 'Y')
  			{
  				// change to no
  				$sql_order_update = "update tbl_orders set delivery_status='N' where order_id=$order_id";
  				// Execute SQL Query
  				$res_order_update = mysqli_query($conn,$sql_order_update);
  				// Check query executed or not
  				if(mysqli_affected_rows($conn) > 0) 
  				{
  					// Redirect to order.php page so updated data will display
  					$_SESSION['delivery-update'] = "<div class='success text-center'>Delivery status successfully change</div>";
					// Redirect to index.php
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/orders.php';
						</script>
					<?php 
  				}
  				else
  				{
  					// Redirect to order.php page so updated data will display
  					$_SESSION['delivery-update'] = "<div class='error text-center'>Delivery status updation failed</div>";
					// Redirect to index.php
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/orders.php';
						</script>
					<?php 
  				}
  				
  			}
  			else
  			{
  				// change to yes
  				$sql_order_update = "update tbl_orders set delivery_status='Y' where order_id=$order_id";
  				// Execute SQL Query
  				$res_order_update = mysqli_query($conn,$sql_order_update);
  				// Check query executed or not
  				if(mysqli_affected_rows($conn) > 0) 
  				{
  					// Redirect to order.php page so updated data will display
  					$_SESSION['delivery-update'] = "<div class='success text-center'>Delivery status successfully change</div>";
					// Redirect to index.php
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/orders.php';
						</script>
					<?php 
  				}
  				else
  				{
  					// Redirect to order.php page so updated data will display
  					$_SESSION['delivery-update'] = "<div class='error text-center'>Delivery status updation failed</div>";
					// Redirect to index.php
					?>
						<script type="text/javascript">
							window.location.href='<?php echo SITEURL; ?>admin/orders.php';
						</script>
					<?php 
  				}
  			}
  		}
	}
?>