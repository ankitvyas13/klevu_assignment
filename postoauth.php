<?php
include 'config/config.php';
include 'functions.php';
// Set variables for our request

$params = $_GET; // Retrieve all request parameters
$hmac = $_GET['hmac']; // Retrieve HMAC request parameter

$params = array_diff_key($params, array('hmac' => '')); // Remove hmac from params
ksort($params); // Sort params lexographically

$computed_hmac = hash_hmac('sha256', http_build_query($params), $shared_secret);

// Use hmac data to check that the response is from Shopify or not
if (hash_equals($hmac, $computed_hmac)) {

	
	$query = array(
		"client_id" => $api_key, // Your API key
		"client_secret" => $shared_secret, // Your app credentials (secret key)
		"code" => $params['code'] // Grab the access key from the URL
	);

	$access_token_url = "https://" . $_GET['shop'] . "/admin/oauth/access_token";
	
	$result = executePHPCurl($access_token_url, "POST", $query);
	
	
	$access_token = $result['access_token'];
	$sql = "SELECT * FROM client_stores where url = '".$_GET['shop']."'";
	$result = $conn->query($sql);

	if ($result->num_rows < 0) {
		$shop_name = explode('.',$_GET['shop']);
		$sql = "INSERT INTO client_stores (store_name, token, url)
		VALUES ('".$shop_name[0]."', '".$access_token."', '".$_GET['shop']."')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	
	header("Location: index.php?shop=".$_GET['shop']);
	
} else {
	die('This request is NOT from Shopify!');
}


?>