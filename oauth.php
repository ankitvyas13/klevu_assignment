<?php
	//User Authentication
	include 'config/config.php';		
	$shop = isset($_GET['shop']) ? $_GET['shop'] : '';
		
	// Build install/approval URL to redirect to
	$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);
	
	header("Location: ".$install_url);
	exit;
?>