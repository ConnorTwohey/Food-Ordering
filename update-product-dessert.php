 <?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_NAME', 'Online_Food_Ordering');
	
 	function update_product($name, $password, $finit, $lname, $address, $phoneno, $email, $credits){
		try{
			$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
		
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			print "Connected to database. <br><br>";
		
		} catch(PDOException $error){
			die("ERROR: Could not connect. " . $error->getMessage());
		}
		
		$pdo->beginTransaction();
		print "Transaction has begun.<br>";
		
		print "Locking.<br>";
		$pdo->exec('LOCK TABLES `Customer` WRITE');
		print "Customer table is locked<br>";
		
		
		try{
			$stmt = $pdo->prepare("UPDATE `Product` SET WHERE ProductId=:idno");
			
			$stmt->bindParam(':uname', $name, PDO::PARAM_STR, 12);
			$stmt->execute();
			$pdo->commit();
			
			$pdo->exec('UNLOCK TABLES');
			print "Unlock table. Successful transaction<br>";
			
			$pdo = null;
			
		}
		catch(PDOException $error) {
			$pdo->rollback();
			print("Rollingback <br>");
			die("ERROR: Could not complete. " . $error->getMessage());
		}
	}
	?> 