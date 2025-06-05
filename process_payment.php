<?php
// Database Connection
$host = "localhost:3307";
$dbname = "restoomodify";
$username = "root";
$password = " ";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Payment Processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume $userId and $amount are received from the frontend form
    $userId = intval($_POST['user_id']);
    $amount = floatval($_POST['amount']);

    // Insert payment into the database
    $stmt = $pdo->prepare("INSERT INTO payments (user_id, amount) VALUES (:user_id, :amount)");
    $stmt->execute([
        ':user_id' => $userId,
        ':amount' => $amount
    ]);

    // Redirect to Admin Dashboard
    header("Location: admin_dashboard.php?payment_success=1");
    exit;
}
?>
