<?php
header('Content-Type: application/json');
$servername = "localhost:3307";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "restoomodify"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

$sql = "SELECT id, name, price FROM dishes";
$result = $conn->query($sql);

$dishes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dishes[] = $row;
    }
}

echo json_encode($dishes);
$conn->close();
?>
