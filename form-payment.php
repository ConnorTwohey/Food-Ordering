<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
  include 'insert-payment.php';

  // defining variables
  $cid = $eid = $pid = 0;
  $deliver = false;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cid = $_POST["CustId"];
    $eid = $_POST["EmpId"];
    $pid = $_POST["ProdId"];
    $deliver = $_POST["Is_Delivery"];

    if(empty($cid)) {
      $cidErr = "Customer ID is required";
    }

    if(empty($eid)) {
      $eidErr = "Employee ID is required";
    }

    if(empty($pid)) {
      $pidErr = "Product ID is required";
    }

    if($cidErr == "" && $eidErr == "" && $pidErr == "") {
      echo "Form has been sent.<br>";
      insert_order($cid,$eid,$pid,$deliver);
      echo "Query has been sent<br>";
    }

  }

  ?>

  <h2>Order Input Form</h2>

  <p><span class="error">* required field.</span></p>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Customer ID: <input type="text" name="CustId" value="<?php echo $cid;?>">
      <span class="error">* <?php echo $cidErr;?></span><br><br>

    Employee ID: <input type="text" name="EmpId" value="<?php echo $eid;?>">
      <span class="error">* <?php echo $eidErr;?></span><br><br>

    Product ID: <input type="text" name="ProdId" value="<?php echo $pid;?>">
      <span class="error">* <?php echo $pidErr;?></span><br><br>

    Is Delivery: <input type="text" name="Is_Delivery" value="<?php echo $deliver;?>">

    <input type="submit" name="submit" value="Submit">
  </form>
  <p>Click the "Submit" button to input Order data.</p>
  <p><a href="http://localhost:8888/">&lt;Back to index&gt;</a></p>

</body>
</html>
