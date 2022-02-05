<?php 
	// Database configuration
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "klevu_assignment";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Shopify configuration
	$api_key = '37820729e83cb78c90b936e817d3a279';	//App Key
	$shared_secret = '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';		//App Secret
	$scopes = "read_orders,read_draft_orders,read_products,write_products,read_customers,read_inventory";
	$site_url = 'https://d803-117-99-60-8.ngrok.io'; // local ngrok url
	$redirect_uri = $site_url."/klevu_public_app/postoauth.php";
	
?>