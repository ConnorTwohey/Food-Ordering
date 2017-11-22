<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
	<h2>Appetizer Input Form</h2>

    <p><span class="error">* required field.</span></p>

	<form action="insert-appetizer.php" method="post" enctype="multipart/form-data">
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
    Size: <input type="text" name="Size" value="<?php echo $deliver;?>">
    	&nbsp;&nbsp;&nbsp;&nbsp;S, M, or L. <br><br>
	<input type="submit" name="submit" value="Submit">
	</form>
	<p>Click the "Submit" button to input Appetizer data.</p>


	<p><a href="http://localhost:8888/">&lt;Back to index&gt;</a></p>

</body>
</html>
