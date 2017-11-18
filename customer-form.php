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

$name = $_POST["UserName"];
$pass = $_POST["Password"];
$init = $_POST["Finit"];
$lname = $_POST["Lname"];
$address = $_POST["Address"];
$phone = $_POST["PhoneNo"];
$email = $_POST["Email"];

$sql = "INSERT INTO `Customer` (`UserName`, `Password`, `Finit`, `Lname`, `Address`, `PhoneNo`, `Email`) VALUES ('$name', '$pass', '$init', '$lname', '$address', '$phone', '$email');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 