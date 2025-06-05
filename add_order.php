<?php
// Database connection
$conn = new mysqli('localhost:3307', 'root', '', 'restoomodify'); // Update database credentials

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

// Get data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Insert orders into the database
foreach ($data as $item) {
    $dish_id = $item['id'];
    $quantity = $item['quantity'];
    $total_price = $item['price'] * $quantity;

    $stmt = $conn->prepare("INSERT INTO user_orders (user_id, dish_id, quantity, total_price) VALUES (?, ?, ?, ?)");
    $user_id = 1; // Example user ID (update with actual logged-in user ID if available)
    $stmt->bind_param("iiid", $user_id, $dish_id, $quantity, $total_price);
    $stmt->execute();
}

echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);
?>
