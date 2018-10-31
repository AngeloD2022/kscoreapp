<?php

$conn = new mysqli("localhost", "root", null, "scoreboard");
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM events";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
            $resultArray[] = $row;
            echo json_encode($resultArray);
    }
} else {
    echo "error_noevents";
}
$conn->close();

?>