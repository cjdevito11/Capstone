 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="../css/login.css">
 </head>
 
<body id="body">
<center>
<?php
//action='$SELF' onSubmit=\"validate(this)
function getLogininfo(){
	echo "<div class='loginContainer' id='loginContainer'>";
	//echo "<form name='loginForm' action='$PHP_SELF' onsubmit='return false' method='post'>";
	echo "<form name='loginForm' action='$PHP_SELF' method='post'>";
	
	echo "<div class='username'>";
		echo "<input type='text' placeholder='Enter Username' name='username' required>";
	echo "</div>";
	
	echo "<div class='password'>";
		echo "<input type='password' placeholder='Enter Password' name='password' required>";
	echo "</div>";
	
	echo "<div class='buttons'>";
      echo "<button class = 'loginButton' type='submit'>Login</button>";
	  echo "<button class = 'signUpButton' type='submit'>Sign Up</button>";
	echo "</div>";
}

function getUserInfo($u,$pw,$f){
	$ans = "N/A";
	$sql = "select $f from users where username='$u' and password='$pw'";
	$result = mysql_query($sql) or die("Error: " . $sql);
	if ($row = mysql_fetch_assoc($result)){
		$ans = $row[$f];
	}
	return $ans;
}
/*
function validUser($u,$pw,$enc) {
	$valid = false;
	if ($enc=='y') {
		$begin = "md5(";
		$end = ")";
	} else {
		$begin="";
		$end="";
	}
	
	$sql = "select * from users where username='$uname' and password=$begin'$psw'$end";
	$result = mysql_query($sql) or die("Error: " . $sql);
	if (mysql_num_rows($result)>0) {
		$valid = true;
	}
	return $valid;
	}
	*/
function validUser($u,$pw) {
	$valid = false;
	$sql = "select * from users where username='$u' and password='$pw'";
	$result = mysql_query($sql) or die("Error: " . $sql);
	if (mysql_num_rows($result)>0) {
		$valid = true;
	}
	return $valid;
}
	
	
	
	

	// ******************************************************* RUNIT **************************************************
	
include ('connect.php');
//include ('siteUser.php');
connect();
//session_start();
//getLoginInfo;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: dash.php");
	exit;
}
$username = $password = "";
$username_err = $password_err = "";

	$r = mysql_query("SELECT DATABASE()");
    //$result = mysql_result($r,0);
	
	echo "$r";


if($_SERVER["REQUEST_METHOD"] == "POST"){
//if(isset($_POST['submit'])){
	//header("location: dash.html");
    // Check if username is empty
   
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
	

	
	
		$valid = false;
        // Prepare a select statement
        $sql = "select * from users where username='$username' and password='$password'";
		
        $result = mysql_query($sql) or die("Error: " . $sql);
		echo "$result";
		if (mysql_num_rows($result)>0) {
			$valid = true;
			echo "CORRECCT LOGIN WHY HASN'T PAGE CHANGED1.";
		}else {
			echo "Incorrect Login.";
		}
		if ($valid === true){
			echo "CORRECCT LOGIN WHY HASN'T PAGE CHANGED2.";
            // Password is correct, so start a new session
            session_start();
                            
            // Store data in session variables
            $_SESSION["loggedin"] = true;
			//$_SESSION["id"] = $id;
            $_SESSION["username"] = $username;                            
                            
            // Redirect user to welcome page
            header("location: dash.html");
        } else {
             // Display an error message if password is not valid
            echo "The username or password you entered was not valid.";
        }
        
    // Close connection
   // mysqli_close($link);
}

getLoginInfo();

?>
	







</center></body>
</html>