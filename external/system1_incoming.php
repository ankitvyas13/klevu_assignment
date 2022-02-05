<?php
include 'config/config.php';
include 'functions.php';

/*
 * 
 * Outgoing system A 
 * in this file we get the post the data from submitted from the system
 * Date will be save based on data posted
 * id, price and images will be saved as per the db
 * 
 */

if($_POST){
	$sql = "SELECT * FROM incoming_products where id = '".$_POST['id']."'";
	$result = $conn->query($sql);
		
	$id = $_POST['id'] ?? null;
	$price = $_POST['price'] ?? null;
	$images = $_POST['images'] ?? null;
	$date = date('Y-m-d H:i:s');
	
	if ($result->num_rows < 0) {
		$sql = "INSERT INTO incoming_products (id, price, images, create_at, update_at)
		VALUES ('".$id."', '".$price."', '".$images."', '".$date."', '".$date."')";		
		$msg = "New record created successfully";
	} else {
		$sql = "UPDATE incoming_products SET price='".$price."' WHERE id='".$id."'";
		$msg = "Record updated successfully";
	}
	
	// Execute the query 
	if ($conn->query($sql) === TRUE) {
		echo $msg;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
}
?>