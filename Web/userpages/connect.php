<html><body>
<?php
function connect(){
	
	$servername = "pi.cs.oswego.edu";
	$username = "cdevito";
	$password = "n3wP4sswd";
	$database = "piptopia";

// Create connection
	$conn = new mysqli($servername, $username, $password, $database);
	
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
}
?>
</body></html>