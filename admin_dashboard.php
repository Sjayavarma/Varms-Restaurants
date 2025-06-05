<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require 'razorpay/config.php'; // Ensure correct forward slashes for cross-platform compatibility

// Fetch total items ordered and total amount
$totalItems = 0;
$totalAmount = 0.0;
$estimatedProfit = 0.0;

try {
    // Fetch data from user_orders and join with dishes to get price
    $stmt = $pdo->query("SELECT SUM(uo.quantity) AS total_items, SUM(uo.total_price) AS total_amount FROM user_orders uo");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalItems = $result['total_items'] ?? 0;
    $totalAmount = $result['total_amount'] ?? 0.0;
    $estimatedProfit = $totalAmount * 0.6; // Assuming 60% profit margin
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Admin Dashboard</h2>
        <a href="add_dish.php" class="btn btn-success mb-3">Add New Dish</a>
        <a href="logout.php" class="btn btn-danger mb-3 float-end">Logout</a>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Items Ordered</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalItems; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Revenue</div>
                    <div class="card-body">
                        <h5 class="card-title">₹<?php echo number_format($totalAmount, 2); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Estimated Profit (60%)</div>
                    <div class="card-body">
                        <h5 class="card-title">₹<?php echo number_format($estimatedProfit, 2); ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Make Order Button -->
        <div class="mb-4">
            <a href="razorpay\razorpay_order.php" class="btn btn-outline-dark btn-lg">🛒 Make Order & Pay with Razorpay
            </a>
        </div>

        <!-- Dishes Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Dish ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM dishes");
                    while ($dish = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dish['id']); ?></td>
                        <td><?php echo htmlspecialchars($dish['name']); ?></td>
                        <td>₹<?php echo htmlspecialchars($dish['price']); ?></td>
                        <td>
                            <a href="delete_dish.php?id=<?php echo urlencode($dish['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php 
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='4'>Failed to fetch dishes: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
