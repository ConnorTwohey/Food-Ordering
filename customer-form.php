 <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Online_Food_Ordering";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `Customer` (`UserName`, `Password`, `Finit`, `Lname`, `Address`, `PhoneNo`, `Email`) VALUES ('$_POST[UserName]', '$_POST[Password]', '$_POST[Finit]', '$_POST[LastName]', '$_POST[Address]', '$_POST[Phoneno]', '$_POST[Email]');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 