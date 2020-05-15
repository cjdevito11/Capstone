<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/entry.css">
</head>
<body>

<?php

	$time = time();
	$date = date();
	
	$servername = "pi.cs.oswego.edu";
	$dbusername = "cdevito";
	$password = "n3wP4sswd";
	$database = "piptopia";

// Create connection
	$conn = new mysqli($servername, $dbusername, $password, $database);
	
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
session_start();

// CHECK IF LOGGED IN
$loggedin = $_SESSION['loggedin'];
$username = $_SESSION['username'];

	if($loggedin != true){
	header("location: login.php");
	exit;
}

	if($_SERVER["REQUEST_METHOD"] == "POST"){

    $header = trim($_POST["header"]);
	$message = trim($_POST["message"]);
	$type = trim($_POST["type"]);
	$importance = trim($_POST["importance"]);
	$color = trim($_POST["color"]);
	$teamname = trim($_POST["teamname"]);
	
	
	//$signler = $_SESSION["username"];		//FIX
	//$teamname = $_SESSION["teamname"];		//FIX
	

	$sql = "INSERT INTO alerts (header,message,type,importance,color,signaler,teamname)
VALUES ('$header', '$message', '$type', '$importance','$color','$username','$teamname')";
		
	if ($conn->query($sql) === TRUE) {
		header("location: dash.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	}

?>









<center>
<div class ="alertEntry" id="alertEntry">
	
	<form name='signalForm' action='<?php echo "$PHP_SELF" ?>' method='post'>
	
	<input type="text" placeholder="Enter Header" name="header" required><br>

	<input type="text" placeholder="Enter Message" name="message" required><br>

	<input type="text" placeholder="Enter Type" name="type" required><br>
	
	<input type="number" placeholder="Enter Importance" name="importance" required><br>
	
	<input type="text" placeholder="Enter Color" name="color" required><br>
	
	<input type="text" placeholder="Enter Team Name" name="teamname" required><br>
	
	<button class = "submitButton" type="submit">Submit</button>
	<button class = "clearButton"  type= "reset">Clear</button>
	
	</form>
</center>
</div>

</body>
</html>