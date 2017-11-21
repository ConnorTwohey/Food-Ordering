<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', 'root');
  define('DB_NAME', 'Online_Food_Ordering');

  function insert_appetizer($pname, $descrip, $price, $fpath, $stock, $cal, $fats, $size) {
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
    print "Product table is locked<br>";

    try {
      $stmt = $pdo->prepare("INSERT INTO `Product` (`Product_Name`, `Description`, `Price`, `Product_Image`, `Num_In_Stock`, `Calories`, `Fats`)  VALUES (:name, :desc, :price, :image, : stock, :calories, :fats);");

      $stmt->bindParam(':name', $pname, PDO::PARAM_STR, 12);
      $stmt->bindParam(':desc', $descrip, PDO::PARAM_STR, 256);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':image', $image);
      $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
      $stmt->bindParam(':calories', $calories, PDO::PARAM_INT);
      $stmt->bindParam(':fats', $fats, PDO::PARAM_INT);
      $stmt->execute();

      $stmt = $pdo->prepare("SELECT ProductId FROM Product WHERE Product_Name = :pname");
      $stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetch();
      $pid = $row['ProductId'];

      $stmt = $pdo->prepare("INSERT INTO `Appetizer` (`Pid`, `Size`) VALUES (:pid, :size);");
      $stmt->bindParam(':pid',$pid);
      $stmt->bindParam(':size',$size);

      $pdo->commit();

      $pdo->exec('UNLOCK TABLES');

      $pdo = null;

    }
    catch(PDOException $error) {
			$pdo->rollback();
			print("Rollingback <br>");
			die("ERROR: Could not complete. " . $error->getMessage());
		}
  }
?>
