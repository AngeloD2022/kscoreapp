<?php

$conn = new mysqli("localhost", "root", null, "scoreboard");
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}


$sql = "SELECT id, homeScore, oppScore FROM events WHERE deleted=0";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
            $resultArray[] = $row;
    }
} else {
    echo "error_noevents";
}
$conn->close();
echo json_encode($resultArray);

?>