 <?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_NAME', 'Online_Food_Ordering');
	
 	function insert_dessert($pname, $descrip, $price, $fpath, $stock, $cal, $fats, $iscold){
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
		$pdo->exec('LOCK TABLES `Product` WRITE');
		print "Customer table is locked<br>";
		
		
		try{
			$stmt = $pdo->prepare("INSERT INTO `Product` (`Product_Name`, `Description`, `Price`, `Product_Image`, `Num_In_Stock`, `Calories`, `Fats`)  VALUES (:name, :desc, :price, :image, : stock, :calories, :fats);");
			
			$stmt->bindParam(':name', $name, PDO::PARAM_STR, 12);
			$stmt->bindParam(':desc', $descrip, PDO::PARAM_STR, 256);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':image', $image);
			$stmt->bindParam(':stock', $name, PDO::PARAM_INT);
			$stmt->bindParam(':calories', $calories, PDO::PARAM_INT);
			$stmt->bindParam(':fats', $fats, PDO::PARAM_INT);
			$stmt->execute();
			
			$pid = $pdo->query("SELECT ProductId WHERE Product_Name=$name");
			
			$stmt = $pdo->prepare("INSERT INTO `Dessert` (`Pid`, `IsCold`) VALUES (:pid, :iscold);");
			$stmt->bindParam(':pid', $pid);
			$stmt->bindParam(':iscold', $iscold
			
			$pdo->commit();
			
			$pdo->exec('UNLOCK TABLES');
			print "Customer entry has commited.<br>Unlock table. <br>";
			
			print "Successful transaction<br>";
			$pdo = null;
		}
		catch(PDOException $error) {
			$pdo->rollback();
			print("Rollingback <br>");
			die("ERROR: Could not complete. " . $error->getMessage());
		}
	}
	?> 