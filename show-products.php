<?php
 	require('config.php');
	
	print "<table border = '1'><tr><th>ID No.</th><th>Username</th><th>Password</th><th>Name</th>
	<th>Address</th><th>Phone No.</th><th>Email</th><th>Created by</th><th>Credits</th></tr>";
	
	$pdo->beginTransaction();
	
	$pdo->exec('LOCK TABLES `Customer` WRITE');
	try{
		$sql = 'SELECT * FROM Customer ORDER BY IdNo';
		foreach ($pdo->query($sql) as $row) {
			print "<tr>";
			print "<td>" . $row['IdNo'] . "</td>";
			print "<td>" . $row['UserName'] . "</td>";
			print "<td>" . $row['Password'] . "</td>";
			print "<td>" . $row['Finit'] . ". " . $row['Lname'] . "</td>";
			print "<td>" . $row['Address'] . "</td>";
			print "<td>" . $row['PhoneNo'] . "</td>";
			print "<td>" . $row['Email'] . "</td>";
			print "<td>" . $row['CreatedDate'] . "</td>";
			print "<td>" . $row['Credits'] . "</td>";
		}
		$pdo->commit();
	}
	catch(PDOException $e){
		$pdo->rollBack();
	}
	$pdo->exec('UNLOCK TABLES');
	$pdo->close ();
?>