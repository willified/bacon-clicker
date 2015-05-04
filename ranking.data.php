<?php
$mysqli = new mysqli('localhost','root','','bacon_clicker');
$myArray = array();
if ($result = $mysqli->query("SELECT * FROM bacon_data ORDER BY bacon+(egg*1.2) DESC LIMIT 10")) {

    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = $row;
    }
	header('Content-Type: application/json');
    echo json_encode($myArray);
}

$result->close();
$mysqli->close();
?>