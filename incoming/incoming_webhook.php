<?php
include 'config.php';
include 'functions.php';

$shop = $_SESSION['shop'] ?? null;
$token = $_SESSION['token'] ?? null;
/**
 * PIM sending imformation regarding the product
 * And assume that the receiveing product with some response from 
 * the PIM as below and save to the shopify site
 */
$url = "https://remote-system1.com/v1/product";

$response = executePHPCurl($url,"GET");

// As per the PIM we get below response
$response = '
[
	{
		"id": 1,
		"name": "My Product",
		"prices": {
			"was": "123.45",
			"now": "99.00"
		},
		"description": "This is a great product",
		"images": [
		"https://my-website.com/image1.jpg"
		],
		"meta": {
			"created_at": "2020-12-10 08:53:12",
			"updated_at": "2020-12-10 18:42:57"
		}
	}
]';

$result = json_decode($response, true);
if(!empty($result)){
	foreach($result as $data){
		/*
		 * Create product Payload for shopify 
		 * As per the assignment only name and price will be sent in shopify product
		 */
		$post_payload_product = [
			"product" => [
				"published_scope" => "global",
				"status" => "active",
				"title" =>  $data['name'] ?? null,
				"variants" => [
					[
						"price" => $data['name']['prices']['now'] ?? null,				
						"inventory_management" => "shopify"
					]
				]
			]
		];

		/*
		 * Create product in shopify 
		 */
		$post_shopify_product_url = $shop . "/admin/api/2022-01/products.json";
		executePHPCurl($post_shopify_product_url, "POST", $post_payload_product, $token);

		/*
		 * Outgoing request to Remote System A
		 */
		$x=0;		
		// create an array of all images which receiveing in the payload
		foreach($data['images'] as $image){
			$allImage[$x] = $image;
			$x++;
		}
		$post_payload_product_A = [	
			"id" => $data['id'] ?? null
			"price" => $data['name']['prices']['now'] ?? null
			"image" => $allImage ?? null
		];
		
		// To save the data in the outgoing_A system
		// this will call system1_incoming.php
		$outgoing_A_url = "https://some-remote-system.com/v1/incoming";
		executePHPCurl($outgoing_A_url, "POST", $post_payload_product_A);
		
	}
}

/*
 * Outgoing request to Remote System B
 */

$outgoing_B_url = "https://another-remote-system.com/v3/changed-ids";
executePHPCurl($outgoing_B_url, "GET", $ids);
/*
 * this will call file system2_incoming.php
 * it will checked data which are updated from the request
 * and it returns the ids 
 */
?>