<?php

// (A) CONNECT TO DATABASE
$con = mysqli_connect("localhost","root","","notebookdb");
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// (B) GET TEXT
//Get id
$iidee = $_POST["idd"];
//Check if username is empty
if (empty($iidee)) {
	echo '<script type="text/javascript">';
	echo ' alert("The id can not be empty.");';
	echo ' setInterval(function(){ window.location = "note.html"; }, 100);';
	echo '</script>';
}else{
	//Get text for that user id | if no text, do nothing, only login. if there is text, merge with current text
	$sql = "SELECT user_text FROM user_ids WHERE user_id='" .mysqli_real_escape_string($con,$iidee). "'";
	$result = mysqli_query($con,$sql);
	//$result_row = mysqli_fetch_array($result);
	while ($result_row = $result->fetch_assoc()) {
		echo $result_row['user_text']."<br>";
	}
	
	//Check if user id exists
	if (mysqli_num_rows($result) > 0) {
		//Get the text
		echo $result_row; //Tässä toimii
		echo '<script type="text/javascript">';
		echo ' var text_result = "$result_row";'; //Mutta tässä ei
		echo ' localStorage.setItem("note1",text_result);'; //Tää pitäis ehkä tehdä siinä alkuperäisessä tiedostossa???
		echo ' alert("Welcome!");';
		echo ' setInterval(function(){ window.location = "note.html"; }, 100);';
		echo '</script>';
	}else{
		//Create new user id
		$sql = "INSERT INTO user_ids (user_id,user_text) VALUES ('" .mysqli_real_escape_string($con,$iidee). "','testi_text')";
		if (mysqli_query($con,$sql) === TRUE) {
		  echo "New record created successfully";
		}else{
		  echo "Error: " . $sql . "<br>" . mysqli_error();
		}
	}
}

// (C) CLOSE DATABASE CONNECTION
mysqli_close($con);

?>