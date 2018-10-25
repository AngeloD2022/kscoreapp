<?php


if(htmlspecialchars($_COOKIE["ksb_usr"]) != null && htmlspecialchars($_COOKIE["ksb_pw"]) != null){
	$username = htmlspecialchars($_COOKIE["ksb_usr"]);
	$password = htmlspecialchars($_COOKIE["ksb_pw"]);
}
$username = isset($_GET["u"]) ? $_GET["u"] : "x";
$password = isset($_GET["p"]) ? $_GET["p"] : "x";

$conn = new mysqli("localhost", "root", null, "scoreboard");
if($conn->connect_error){
	die("Failed: ". $conn->connect_error);
}
$passEncrypted = hash('sha256', $password);

$sql = "SELECT * FROM users WHERE name='". $username ."' and (passwordSHA256='". $passEncrypted . "' or passwordSHA256='".$_GET["p"]."')";

$result = $conn->query($sql);


if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		if($row["disabled"] == 1){
			echo "disabled";
		}else{
			$resultArray[] = $row;
			echo json_encode($resultArray);
		}
	}
}else{
	echo "not found";
}
$conn->close();
?>