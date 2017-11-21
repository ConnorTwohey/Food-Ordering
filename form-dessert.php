<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
		include 'insert-dessert.php';
		
		// define variables and set to empty values
		$pnameErr = $descripErr = $priceErr = $imageErr = $stockErr = $calErr = $fatsErr = "";
		$pname = $descrip = $image = "";
		$price = $stock = $cal = $fats = $iscold = 0;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			  $pname = test_input($_POST["PName"]);
			  $descrip = test_input($_POST["Description"]);
			  $price = $_POST["Price"];
			  $file = $_POST["Image"];
			  $image = fopen("$file", "rb");
			  $stock = $_POST["Stock"];
			  $cals = $_POST["Calories"];
			  $fats = $_POST["Fats"];
			  $iscold = $_POST["Is_Cold"];
			  
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
				$fatsErr = "Email is required";
			  }
			  
			  if($nameErr == "" && $passwordErr == "" && $finitErr == "" && $lnameErr == "" && $addressErr == "" && $phoneErr == "" && $emailErr == ""){
					echo "Form has been sent.<br>";
				  	insert_dessert($pname, $descrip, $price, $fpath, $stock, $cal, $fats, $iscold);
					echo "Query has been sent<br>";
					
			  }
		}
	?>
	
	<h2>Dessert Input Form</h2>
    
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
    Is Cold: <input type="number" name="Is_Cold" value="<?php echo $deliver;?>" min="0" max="1">
    	&nbsp;&nbsp;&nbsp;&nbsp;1 if cold, 0 if not. <br><br>
	<input type="submit" name="submit" value="Submit">  
	</form>
	<p>Click the "Submit" button to input Dessert data.</p>
	<p><a href="http://localhost:8888/">&lt;Back to index&gt;</a></p>
    
</body>
</html>
