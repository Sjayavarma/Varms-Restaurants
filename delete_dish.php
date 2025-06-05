<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "restoomodify";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM dishes WHERE id = $id");
}

header("Location: admin_dashboard.php");
exit();
