<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
  include 'insert-beverage.php';

  $pnameErr = $descripErr = $priceErr = $imageErr = $stockErr = $calErr = $fatsErr = $sizeErr = "";
		$pname = $descrip = $image = $size = "";
		$price = $stock = $cal = $fats = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    			  $pname = $_POST["PName"];
    			  $descrip = $_POST["Description"];
    			  $price = $_POST["Price"];
    			  $stock = $_POST["Stock"];
    			  $cals = $_POST["Calories"];
    			  $fats = $_POST["Fats"];
            $size = $_POST["Size"];

            $file = $_POST["Image"];
            $image = fopen("$file", "rb");

            echo "$pname, $descrip, $price, $image, $stock, $cal, $fats, $size";


            if (empty($pname)) {
				$pnameErr = "Name is required";
			  }

			  if (empty($descrip)) {
				  $descripErr = "Description is required";
			  }

			  if (empty($price) || $price <= 0) {
				$priceErr = "Price has to be above 0";
			  }

			  if (empty($image)) {
				$imageErr = "Image is required";
			  }

			  if ($stock < 0) {
				$stockErr = "Number in stock is required";
			  }

			  if ($cals < 0) {
				$phoneErr = "Calories are required";
			  }

			  if ($fats < 0) {
				$fatsErr = "Fats are required";
			  }

        if(empty($size)) {
          $sizeErr = "Size is required";
        }

			  if($nameErr == "" && $passwordErr == "" && $finitErr == "" && $lnameErr == "" && $addressErr == "" && $phoneErr == "" && $emailErr == "" && $sizeErr == ""){
					echo "Form has been sent.<br>";
				  	echo "$pname, $descrip, $price, $fpath, $stock, $cal, $fats, $size";
					echo "Query has been sent<br>";

			  }
		}
	?>

  <h2>Beverage Input Form</h2>

  <p><span class="error">* required field.</span></p>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Product name: <input type="text" name="PName" value="<?php echo $pname;?>" maxlength="32">
    <span class="error">* <?php echo $pnameErr;?></span><br><br>

  Description: <input type="text" name="Description" value="<?php echo $descrip;?>" rows="3" cols="40" maxlength="256">
    <span class="error">* <?php echo $descripErr;?></span><br><br>

  Price: <input type="number" step="0.01" name="Price" value="<?php echo $price;?>" maxlength="1">
    <span class="error">* <?php echo $priceErr;?></span><br><br>

  Image: <input type="file" name="Image" value="Upload Image">
    <span class="error">* <?php echo $imageErr;?></span><br><br>

Stock: <input type="number" name="Stock" value="<?php echo $address;?>" min="0">
    <span class="error">* <?php echo $addressErr;?></span><br><br>

Calories: <input type="number" name="Calories" value="<?php echo $phone;?>" min="0">
    <span class="error">* <?php echo $phoneErr;?></span><br><br>

  Fats: <input type="number" name="Fats" value="<?php echo $email;?>" min="0">
    <span class="error">* <?php echo $emailErr;?></span><br><br>

  Size: <input type="text" name="Size" value="<?php echo $size;?>" maxlength="1">
    <span class="error">* <?php echo $sizeErr;?></span><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>
  <p>Click the "Submit" button to input Beverage data.</p>
<p><a href="http://localhost:8888/">&lt;Back to index&gt;</a></p>

</body>
</html>
