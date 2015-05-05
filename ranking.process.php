<?php
$link = mysqli_connect("localhost", "root", "");
$select_db = mysqli_select_db($link, "bacon_clicker");
if (isset($_POST['name']) && trim($_POST['name']) != '') {
	$name = mysql_real_escape_string($_POST['name']);
	$bacon = mysql_real_escape_string($_POST['bacon']);
	$egg = mysql_real_escape_string($_POST['egg']);
	$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
	$sql = "INSERT INTO bacon_data (name, bacon, egg, ip)
			VALUES ('$name', '$bacon', '$egg', '$ip')";
	$result = mysqli_query($link, $sql); 
	
}
mysqli_close($link);
?>