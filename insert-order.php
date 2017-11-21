<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'Online_Food_Ordering');

    function insert_order($cid,$eid,$pid,$deliver){
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
        $pdo->exec('LOCK TABLES `FoodOrder` WRITE, `PRODUCT` WRITE');
        print "Customer table is locked<br>";

        try{
            $stmt1 = $pdo->prepare("INSERT INTO `FoodOrder` (`CmId`, `EmpId`, `Pid`, `Is_Delivery`) VALUES (:custid, :empid, :prodid, :deliv);");

            $stmt1->bindParam(':custid', $cid, PDO::PARAM_INT);
            $stmt1->bindParam(':empid', $eid, PDO::PARAM_INT);
            $stmt1->bindParam(':prodid', $pid, PDO::PARAM_INT);
            $stmt1->bindParam(':deliv', $deliver, PDO::PARAM_BOOL);
            $stmt1->execute();
			
			$stock = $pdo->query("SELECT Num_In_Stock FROM Product WHERE ProductId = $pid");
			
			echo "Order inserted. Deincrementing product stock $stock.<br>";
			
			$stock--;

			$stmt2 = $pdo->prepare("UPDATE `FoodOrder` SET Num_In_Stock = :stock WHERE ProductID = :prodid;");
            $stmt2->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt2->bindParam(':prodid', $pid, PDO::PARAM_INT);
			$stmt2->execute();
			
			print "Product deincrmented.<br>";

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
