<?php
include 'config/config.php';

$sql = "SELECT * FROM client_stores where url = '".$_GET['shop']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$shop = $row['store_name'];
		$token = $row['token'];
	}
}

?>
<html>
	<head>
	</head>
	<body>
		<center>
			<h1>Welcome to Klevu Shopify App, <?php echo $shop ?></h1>
		</center>
	</body>
</html>