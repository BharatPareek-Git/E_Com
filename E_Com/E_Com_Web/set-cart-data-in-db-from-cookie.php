<?php 
	if(isset($_COOKIE['user-success-login']))
	{
		// current user is logged in
		// set cart details on Db 

		// two posible scenories 
		// 1.) user add first time product
		// 2.) more than one time user add product

		// so first check that product_id is already exist in db if yes than update by 1
		// otherwise insert product_id and initiallize by

		// ----------------------------------------------------------------------------
		// data is inserted in DB using cookie
		$temp_cart_data = $_COOKIE['user-add-to-cart-cookie'];
		// convert it into json object to an array

		$temp_cart_data = json_decode($temp_cart_data,true);

		// now check data is present in DB or not
			
		$user_name = $_COOKIE['user-success-login'];
		$sql_user_id_fetch = "select * from user where username='$user_name'";
			
		// execute sql query
		$res_user_id_fetch = mysqli_query($conn,$sql_user_id_fetch);
		// count rows 
		$count_user_id_fetch = mysqli_num_rows($res_user_id_fetch);

		if($count_user_id_fetch == 1)
		{
			// user is vaild and available
			// fetch user_id
			$row_user_id_fetch = mysqli_fetch_assoc($res_user_id_fetch);
			$user_id = $row_user_id_fetch['user_id'];
		
			// check product is already in cart or not
			// SQL Query

			// for this we use previously set cart cookies
			foreach ($temp_cart_data as $key => $value)
			{
				$sql_cart = "select * from tbl_cart where user_id=$user_id and product_id=$key";	
				// execute SQL Query
				$res_cart = mysqli_query($conn,$sql_cart);					
				// count rows
				$count_cart = mysqli_num_rows($res_cart);

				// now if count is equal to one then product is already in cart need to update
				if($count_cart == 1)
				{
					// update cart product quantity by one
					// SQL Query for update
					$sql_update_product_cart = "update tbl_cart set product_quantity=$value where user_id=$user_id and product_id=$key";
					// execute SQL Query
					$res_update_prduct_cart = mysqli_query($conn,$sql_update_product_cart);
					// check update done or not
				}
				else
				{
					// insert product and quantity 
					// SQL Query
					$sql_insert_product_cart = "insert into tbl_cart (product_id,product_quantity,user_id) values($key,$value,$user_id)";
					// execute SQL Query
					$res_sql_insert_cart = mysqli_query($conn,$sql_insert_product_cart);
				}

			}	
		}
	}
?>