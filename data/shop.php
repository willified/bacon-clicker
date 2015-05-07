<?php
$mysqli = new mysqli('localhost','root','','bacon_clicker');
error_reporting(0);
$id = mysql_real_escape_string($_GET['id']);
$type = mysql_real_escape_string($_GET['type']);
$myArray = array();
if ($id >= 1) {
	if ($result = $mysqli->query("SELECT * FROM bacon_shop WHERE id = $id ORDER BY type ")) {

    while($row = $result->fetch_array(MYSQL_ASSOC)) {
		$myArray[] = $row;
    }
	header('Content-Type: application/json');
    echo json_encode($myArray);
	}
} else if ($type >= 1) { 
	if ($result = $mysqli->query("SELECT * FROM bacon_shop WHERE type = $type ORDER BY id ")) {
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$myArray[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($myArray);
	}
} else { 
	if ($result = $mysqli->query("SELECT * FROM bacon_shop ORDER BY type ")) {
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$myArray[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($myArray);
	}
}

$result->close();
$mysqli->close();
?>