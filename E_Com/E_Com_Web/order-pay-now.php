<!-- include constants for DB and Constants -->
<?php 
	include_once("config/constants.php");
?>
 <!-- Check user is logged in or not -->
<?php 
	include_once("user-authenication-check.php");
?>
<?php 
	// check order id is set or not
	if(isset($_GET['oid']))
	{
		$order_id = $_GET['oid'];
		$sql_order_update = "update tbl_orders set payment_status='Y' where order_id=$order_id";
  		// Execute SQL Query
  		$res_order_update = mysqli_query($conn,$sql_order_update);
  		// Check query executed or not
		if(mysqli_affected_rows($conn) > 0) 
  		{
  			// Redirect to order.php page so updated data will display
  			$_SESSION['payment-msg'] = "<div class='success text-center'>Your Payment Completed</div>";
			// Redirect to index.php
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>orders.php';
				</script>
			<?php 
  		}
  		else
  		{
  			// Redirect to order.php page so updated data will display
  			$_SESSION['payment-msg'] = "<div class='error text-center'>Your Payment is failed</div>";
			// Redirect to index.php
			?>
				<script type="text/javascript">
					window.location.href='<?php echo SITEURL; ?>orders.php';
				</script>
			<?php 
  		}
	}
?>