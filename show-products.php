<html>
<head>
<title>All products</title>
<style type="text/css">
	table, th, td {
		border: 1px solid black;
		text-align:center
	}
	table tr:nth-child(odd) {
		background-color: #ccc;
	}
</style>
</head>
<body>
	<?php	require('config.php'); ?>
    
	<h2>All Product Records</h2>
    
    <?php
		print "<table style=width:100%><tr><th>Product_Image</th><th>ProductId</th><th>Product_Name</th><th>Description</th><th>Price</th><th>Num_In_Stock</th><th>Calories</th><th>Fats</tr>";
		
		$pdo->beginTransaction();
		
		$pdo->exec('LOCK TABLES `Product` WRITE');
		try{
			$sql = 'SELECT * FROM Product ORDER BY ProductID';
			foreach ($pdo->query($sql) as $row) {
				print "<tr>";
				print "<td>" . '<img src="data:image/jpeg;base64,'.base64_encode( $row['Product_Image'] ).'"/>' . "</td>";
				print "<td>" . $row['ProductId'] . "</td>";
				print "<td>" . $row['Product_Name'] . "</td>";
				print "<td>" . $row['Description'] . "</td>";
				print "<td>" . $row['Price'] . "</td>";
				print "<td>" . $row['Num_In_Stock'] . "</td>";
				print "<td>" . $row['Calories'] . "</td>";
				print "<td>" . $row['Fats'] . "</td></tr>";
			}
			print "</table><br>";
			$pdo->commit();
			
			$pdo->exec('UNLOCK TABLES');
			print "Unlock table. Successful transaction<br>";
			
			$pdo = null;
		}
		catch(PDOException $e){
			$pdo->rollBack();
		}
	?>
    
	<p><a href="http://localhost:8888/">&lt;Back to index&gt;</a></p>
</body>
</html>