<?php
// (A) CONNECT TO DATABASE
$con = mysqli_connect("localhost","root","","notebookdb");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// (B) ADD USER
//Get username & password
$user_name = $_POST["username"];
$pass_word = $_POST["password"];

$sql = "INSERT INTO users (username, password1, text1) VALUES ($user_name, $pass_word, 'text')";
$sql = "INSERT INTO users (username, password, text) VALUES ($user_name, $pass_word, 'text')";

//Check if username or password is empty
if (empty($user_name) || empty($pass_word)) {
		echo '<script type="text/javascript">';
		echo ' alert("The username or password can not be empty.");';
		echo ' setInterval(function(){ window.location = "note.html"; }, 100);';
		echo '</script>';
}
//Check if username exists
$sql=mysqli_query($con,"SELECT FROM users (username, password1, text1) WHERE username=$user_name");
 if (!$sql || mysqli_num_rows($sql)>=1) {
		echo '<script type="text/javascript">';
		echo ' alert("Username already exists.");';
		echo ' setInterval(function(){ window.location = "note.html"; }, 100);';
		echo '</script>';
   }else{
		//If username does not exist, create new user
		$sql = "INSERT INTO users (username, password1, text1) VALUES ('$user_name', '$pass_word', 'text')";
		echo '<script type="text/javascript">';
		echo ' alert("Your account has been created.");';
		echo ' setInterval(function(){ window.location = "note.html"; }, 100);';
		echo '</script>';
   }

/*/ (C) INSERT USER
$stmt = $pdo->prepare("INSERT INTO 'users' (username,text"); //change username and text to correct ones
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $u) {
  printf("<div>[%u] %s</div>", $u['username'], $u['text']);
}*/

// (D) CLOSE DATABASE CONNECTION
$con->close();
?>