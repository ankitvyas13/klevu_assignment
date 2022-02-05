<?php
/*
 * Function to execute the PHP CURL 
 *
 * @param
 *	$url = string
 *	$req_type = string
 *	$postdata = string
 *	$token = string
 *
 * @return json
 */
function executePHPCurl($url,$req_type="GET",$postdata="",$token="")
{
	$request_headers[] = "Accept : application/json";
	$request_headers[] = "Content-Type : application/json";
	if($token != '')
		$request_headers[] = "X-Shopify-Access-Token: " . $token;
	   
	$curl = curl_init();
   
	curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 10,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => $req_type,    
		CURLOPT_HTTPHEADER => $request_headers,
	)); 

	if ($req_type == 'POST' or $req_type == 'PUT'){
		curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($postdata));
	}   
	$res = curl_exec($curl);
	curl_close($curl);    
	$res = json_decode($res, true);
	
	return $res;
}