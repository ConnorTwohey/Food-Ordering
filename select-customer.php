<?php
	//include 'database.php';
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "Online_Food_Ordering";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully<br>";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
	
	$conn->beginTransaction();
	
	$conn->exec('LOCK TABLES `Customer` WRITE');
	echo "Tables is locked<br>";
	try{
		$sql = 'SELECT Finit, Lname FROM Customer ORDER BY Lname';
		foreach ($conn->query($sql) as $row) {
			print $row['Lname'] . "\t";
			print $row['Finit'] . "<br>";
		}
		$conn->commit();
	}
	catch(PDOException $e){
		$conn->rollBack();
	}
	$conn->exec('UNLOCK TABLES');
	echo "Table is unlocked<br>";
	$conn->close ();
?>