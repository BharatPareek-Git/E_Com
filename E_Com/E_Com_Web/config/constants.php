<?php 
	//Start Sesseion
	session_start();

	//Define Constants
	define('SITEURL','http://localhost/E_Com_Web/');
	define('LOCALHOST','localhost');
	define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','easy_shop_ecom_db');

    //DB connect
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
?>