<?php
$username = "0";
$password = "0";

if (isset($_COOKIE["ksb_usr"]) && isset($_COOKIE["ksb_pswd"])) {
	$username = $_COOKIE["ksb_usr"];
	$password = $_COOKIE["ksb_pswd"];
}
$username = isset($_GET["u"]) ? $_GET["u"] : $username;
$password = isset($_GET["p"]) ? $_GET["p"] : $password;


//Checks if username or password == null
if ($username == "0" || $password == "0") {
	echo "not found";
} else {
	//contacts DB and outputs JSON or error message.
	$conn = new mysqli("localhost", "root", null, "scoreboard");
	if ($conn->connect_error) {
		die("Failed: " . $conn->connect_error);
	}
	$passEncrypted = hash('sha256', $password);

	$sql = "SELECT * FROM users WHERE name='" . $username . "' and (passwordSHA256='" . $passEncrypted . "' or passwordSHA256='" . $password . "')";

	$result = $conn->query($sql);


	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row["disabled"] == 1) {
				echo "disabled";
			} else {
				$resultArray[] = $row;
				echo json_encode($resultArray);
			}
		}
	} else {
		echo "not found";
	}
	$conn->close();

}


?>