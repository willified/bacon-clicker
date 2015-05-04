<?php
$link = mysqli_connect("localhost", "root", "");
$select_db = mysqli_select_db($link, "bacon_clicker");
if (isset($_POST['name'])) {
	$name = mysql_real_escape_string($_POST['name']);
	$bacon = mysql_real_escape_string($_POST['bacon']);
	$egg = mysql_real_escape_string($_POST['egg']);
	$sql = "INSERT INTO bacon_data (name, bacon, egg)
			VALUES ('$name', '$bacon', '$egg')";
	$result = mysqli_query($link, $sql); 
	
}
mysqli_close($link);
?>