 <?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_NAME', 'Online_Food_Ordering');
	
 	function delete_customer($id){
		try{
			$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
		
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			print "Connected to databse. <br><br>";
		
		} catch(PDOException $error){
			die("ERROR: Could not connect. " . $error->getMessage());
		}
		
		$pdo->beginTransaction();
		print "Transaction has begun.<br>";
		
		print "Locking.<br>";
		$pdo->exec('LOCK TABLES `Customer` WRITE');
		print "Customer table is locked<br>";
		
		
		try{
			$stmt = $pdo->prepare("DELETE FROM `Customer` WHERE IdNo=:idno;");
			
			$stmt->bindParam(':idno', $id, PDO::INT);
			$pdo->commit();
			
			$pdo->exec('UNLOCK TABLES');
			print "Customer entry has commited.<br>Unlock table. <br>";
			
			print "Successful transaction<br>";
			$pdo->close();
		}
		catch(PDOException $error) {
			$pdo->rollback();
			print("Rollingback <br>");
			die("ERROR: Could not complete. " . $error->getMessage());
		}
	}
	?> 