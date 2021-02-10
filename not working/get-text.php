<?php
// (A) SETTINGS - CHANGE TO YOUR OWN !
/*error_reporting(E_ALL & ~E_NOTICE);
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');*/

// (B) CONNECT TO DATABASE
$con = mysqli_connect("localhost","root","","notebookdb");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
/*try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, 
    DB_USER, DB_PASSWORD
  );
} catch (Exception $ex) { exit($ex->getMessage()); }*/

// (C) GET TEXT
//Get username
$user_name = $_POST["username"];
//Check if username is empty
if (empty($user_name)) {
	echo '<script type="text/javascript">';
	echo ' alert("The username can not be empty.");';
	echo ' setInterval(function(){ window.location = "note.html"; }, 100);';
	echo '</script>';
}
//Check if username exists
$sql=mysqli_query($con,"SELECT FROM users (username, text) WHERE username=$user_name");
 if (!$sql || mysqli_num_rows($sql)>=1) {
		//If username exists, load text
		$sql = "SELECT text FROM users WHERE username = '$user_name'"; //This should get the text and put it into the javascript variable
		echo '<script type="text/javascript">';
		echo 'localStorage.setItem("note1,$sql");';
		echo 'setInterval(function(){ window.location = "note.html"; }, 100);';
		echo '</script>';
   }else{
		//If username does not exist, create new user
		$sql = "INSERT INTO users (username, text) VALUES ($user_name, 'text')";
   }

/*
$stmt = $con->prepare("SELECT username FROM `users`");
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $u) {
  printf("<div>[%u] %s</div>", $u['username'], $u['text']);
}*/

/*/ (C) GET USERS
$stmt = $pdo->prepare("SELECT * FROM `users`");
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $u) {
  printf("<div>[%u] %s</div>", $u['username'], $u['text']);
}*/

// (D) CLOSE DATABASE CONNECTION
//$pdo = null;
//$stmt = null;
$con->close();