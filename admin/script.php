<?php

$username = isset($_GET["u"]) ? $_GET["u"] : "x";
$password = isset($_GET["p"]) ? $_GET["p"] : "x";


$conn = new mysqli("localhost", "root", null, "scoreboard");
if($conn->connect_error){
	die("Failed: ". $conn->connect_error);
}
$passEncrypted = hash('sha256', $password);

$sql = "SELECT * FROM users WHERE name='". $username ."' and passwordSHA256='". $passEncrypted . "'";

$result = $conn->query($sql);


if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$resultArray[] = $row;
	}
	echo json_encode($resultArray);
}else{
	echo "not found";
}
$conn->close();
?>