<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'Online_Food_Ordering');

    function insert_payment($oid,$cid,$total,$method) {
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
        $pdo->exec('LOCK TABLES `Customer_Payments` WRITE');
        print "Customer_Payments table is locked<br>";

        try{
          $stmt = $pdo->prepare("INSERT INTO `Customer_Payments` (`Cid`,`Oid`,`Payment_Method`,`TotalPrice`) VALUES (:custid, :ordid, :tot, :pay);");

          $stmt->bindParam(':custid', $cid, PDO::PARAM_INT);
          $stmt->bindParam(':ordid', $oid, PDO::PARAM_INT);
          $stmt->bindParam(':tot', $total, PDO::PARAM_STR);
          $stmt->bindParam(':payment', $method, PDO::PARAM_STR);
          $stmt->execute();

          $pdo->commit();

        }
        catch(PDOException $error) {
            $pdo->rollback();
            print("Rollingback <br>");
            die("ERROR: Could not complete. " . $error->getMessage());
        }
    }
?>
