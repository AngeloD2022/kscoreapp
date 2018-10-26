<?php

$conn = new mysqli("localhost", "root", null, "scoreboard");
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}
$passEncrypted = hash('sha256', $password);

$sql = "SELECT * FROM events ";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["disabled"] == 1) {
            echo "disabled Here";
        } else {
            $resultArray[] = $row;
            echo json_encode($resultArray);
        }
    }
} else {
    echo "not found HERE";
}
$conn->close();

?>