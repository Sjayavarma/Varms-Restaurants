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

$name = $price = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);

    if (empty($name) || empty($price)) {
        $error = "Please fill in all fields.";
    } elseif (!is_numeric($price)) {
        $error = "Price must be a number.";
    } else {
        $stmt = $conn->prepare("INSERT INTO dishes (name, price) VALUES (?, ?)");
        $stmt->bind_param("sd", $name, $price);
        $stmt->execute();
        $stmt->close();

        header("Location: admin_dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Dish</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Add New Dish</h2>
        <?php if ($error) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Dish Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price (₹)</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($price) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Dish</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
